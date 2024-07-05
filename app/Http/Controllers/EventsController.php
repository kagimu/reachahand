<?php

namespace App\Http\Controllers;

use App\Helpers\FCM;
use App\Helpers\Utils;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    protected $utils;

    protected $fcm;

    public function __construct(Utils $utils, FCM $fcm)
    {
        $this->utils = $utils;
        $this->fcm = $fcm;
    }

    public function index()
    {
        session(['title' => 'Events News']);
        $events = Event::withCount('comments')->orderBy('id', 'desc')->get();

        return view('events.index', compact('events'));
    }

    public function getEvents()
    {
        // Get all events
        $events = Event::with('user')->withCount('comments')->orderBy('created_at', 'desc')->take(15)->get();

        return response()->json($events);
    }

    public function getEventsByCategory(Request $request)
    {

        $events = Event::with('user')->withCount('comments')->orderBy('created_at')->take(15)->get();

        return response()->json($events);
    }

    public function getEventDetails($id)
    {
        // Get a single event
        $event = Event::with('user', 'comments', 'comments.user', 'comments.replies', 'comments.replies.user')->withCount('comments')->find($id);

        if ($event) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    public function create()
    {

        $event = new Event;

        return view('events.create', compact('event'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'venue' => 'required',
            'date' => 'required',
        ]);

        try {
            if ($validator->fails()) {
                $message = $validator->errors()->all();

                // Check if the request is an AJAX request
                if ($request->ajax()) {
                    return response()->json($message, 400);
                } else {
                    // Redirect back with an error message
                    return redirect()->route('index.events')->with('error', $message);
                }
            } else {
                // Get the authenticated user
                $user = auth()->user();

                $event = new Event();

                $event->title = $request->title;
                $event->description = $request->description;
                $event->venue = $request->venue;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->social_media_links = $request->social_media_links;
                $event->twitter_link = $request->twitter_link;
                $event->date = $request->date;
                $event->user_id = $user->id;


                if ($request->hasFile('main_image')) {
                    $imageFile = $request->file('main_image');
                    $imageExt = $imageFile->getClientOriginalExtension();
                    $imageName = time().'_'.$imageExt;
                    $imagePath = $imageFile->storeAs('events/main_image', $imageName, 'public');
                    $event->main_image = $imagePath;
                }

                // upload labtest documents
                if ($request->hasFile('other_images')) {
                    $images = [];
                    foreach ($request->file('other_images') as $index => $file) {
                        $file_extension = $file->getClientOriginalExtension();
                        $file_name = time().'_'.$index.'.'.$file_extension;
                        $file_path = $file->storeAs('events/other_images', $file_name, 'public');
                        array_push($images, $file_path);
                    }
                    $event->other_images = $images;
                }

                $event->save();

                // Check if the request is an AJAX request
                if ($request->ajax()) {
                    // Return JSON response with event information
                    return response()->json([
                        'message' => 'Event has been created successfully',
                        'event' => $event,
                    ], 200);
                } else {
                    // Redirect back with a success message
                    return redirect()->route('index.events')->with('success', 'Event has been created successfully');
                }
            }
        } catch (Exception $e) {
            // Handle exceptions as needed...

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred.'], 500);
            } else {
                // Redirect back with an error message
                return redirect()->route('index.events')->with('error', 'An error occurred.');
            }
        }
    }

    public function show($id)
    {
        session(['title' => 'Show Event']);
        $event = Event::find($id);

        if (! $event) {
            // Handle the case where the event is not found
            return response()->json(['error' => 'Event not found'], 404);
        }

        $comments = Comment::where('event_id', $event->id)->get();

        return view('events.show', compact('event', 'comments'));
    }

    public function edit($id)
    {

        $event = Event::find($id);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

              'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'date' => 'required',

        ]);

        $event = Event::find($id);
       $event->title = $request->title;
                $event->description = $request->description;
                $event->venue = $request->venue;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->social_media_links = $request->social_media_links;
                $event->twitter_link = $request->twitter_link;
                $event->date = $request->date;

       
        if ($request->hasFile('main_image')) {
                    $imageFile = $request->file('main_image');
                    $imageExt = $imageFile->getClientOriginalExtension();
                    $imageName = time().'_'.$imageExt;
                    $imagePath = $imageFile->storeAs('events/main_image', $imageName, 'public');
                    $event->main_image = $imagePath;
                }

                // upload labtest documents
                if ($request->hasFile('other_images')) {
                    $images = [];
                    foreach ($request->file('other_images') as $index => $file) {
                        $file_extension = $file->getClientOriginalExtension();
                        $file_name = time().'_'.$index.'.'.$file_extension;
                        $file_path = $file->storeAs('events/other_images', $file_name, 'public');
                        array_push($images, $file_path);
                    }
                    $event->other_images = $images;
                }

        $event->save();

        return redirect()->route('index.events')
            ->with('success', 'Event has been updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event has been deleted successfully');
    }

    public function search(Request $request)
    {

        $builder = Event::query()->with('user')->withCount('comments')->orderBy('created_at', 'description');

        $builder->where('description', 'like', '%'.$request->input('query').'%');

        return response()->json($builder->get());
    }

    public function editEvent($id, Request $request)
    {
        $event = Event::findOrFail($id);

        $event->description = $request->description;
        $event->save();

        return response()->json($event);
    }

    public function confirmDelete($id)
    {
        session(['title' => 'Confirm Delete']);
        $event = Event::find($id);

        return view('events.confirm_delete', compact('event'));
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->id);

        if ($event) {
            $event->delete();

            return redirect()->route('index.events')->with('success', 'Event has been deleted successfully');
        } else {
            return redirect()->route('index.events')->with('error', 'Event not found');
        }

    }
}
