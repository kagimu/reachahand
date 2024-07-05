<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Storage;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\Utils;
use App\Models\Comment;
use App\Helpers\FCM;
use App\Models\Reply;

class BlogController extends Controller
{
    protected $utils, $fcm;

    public function __construct(Utils $utils, FCM $fcm)
    {
        $this->utils = $utils;
        $this->fcm = $fcm;
    }

    public function index()
    {
        session(['title' => 'blogs']);
        $blogs = Blog::with('category')->withCount('comments')->orderBy('id', 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function getblogs()
    {
        // Get all blogs
        $blogs = Blog::with('user')->withCount('comments')->orderBy('created_at', 'desc')->take(15)->get();
        return response()->json($blogs);
    }

    public function getblogsByCategory(Request $request)
    {

        $blogs = Blog::with('user')->withCount('comments')->where('category_id', $request->category_name)->orderBy('created_at')->take(15)->get();
        return response()->json($blogs);
    }


    public function getblogDetails($id)
    {
        // Get a single blog
        $blog = Blog::with('user', 'comments', 'comments.user', 'comments.replies', 'comments.replies.user')->withCount('comments')->find($id);
        return response()->json($blog);
    }

    public function create()
    {
        $categories = Category::all();
         $blog = new Blog;
        return view('blogs.create', compact('categories', 'blog'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'numeric|required',
            'name' => 'required',
            'desc' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'owner' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:pdf,jpeg,png,jpg,gif',
        ]);

        try {
            if ($validator->fails()) {
                $message = $validator->errors()->all();

                // Check if the request is an AJAX request
                if ($request->ajax()) {
                    return response()->json($message, 400);
                } else {
                    // Redirect back with an error message
                    return redirect()->route('index.blogs')->with('error', $message);
                }
            } else {
                // Get the authenticated user
                $user = auth()->user();

                        $blog = new Blog();
                        $blog->category_id = $request->category_id;
                        $blog->name = $request->name;
                        $blog->start = $request->start;
                        $blog->desc = $request->desc;
                        $blog->price = $request->price;
                        $blog->location = $request->location;
                        $blog->size = $request->size;
                        $blog->status = $request->status;
                        $blog->end = $request->end;
                        $blog->directions = $request->directions;
                        $blog->bathroom = $request->bathroom;
                        $blog->contact = $request->contact;
                        $blog->owner = $request->input('owner');
                        $blog->user_id = $user->id; // Associate the blog with the user

                        if ($request->hasFile('video')) {
                            $videoFile = $request->file('video');
                            $videoExt = $videoFile->getClientOriginalExtension();
                            $videoName = time() . '_'  . $videoExt;
                            $videoPath = $videoFile->storeAs('videos', $videoName, 'public');
                                $blog->video = $videoPath;
                        }


                        if ($request->hasFile('profile_pic')) {
                            $imageFile = $request->file('profile_pic');
                            $imageExt = $imageFile->getClientOriginalExtension();
                            $imageName = time() . '_'  . $imageExt;
                            $imagePath = $imageFile->storeAs('images/profile', $imageName, 'public');
                            $blog->profile_pic = $imagePath;
                        }

                                        // upload labtest documents 
                        if ($request->hasFile('images')) {
                            $images = [];
                            foreach ($request->file('images') as $index => $file) {
                                $file_extension = $file->getClientOriginalExtension();
                                $file_name = time() . '_' . $index . '.' . $file_extension;
                                $file_path = $file->storeAs('images/landlords', $file_name, 'public');
                                array_push($images, $file_path);
                            }
                            $blog->images = $images;
                        }

                $blog->save();

                // Check if the request is an AJAX request
                if ($request->ajax()) {
                    // Return JSON response with blog information
                    return response()->json([
                        'message' => 'blog has been created successfully',
                        'blog' => $blog,
                    ], 200);
                } else {
                    // Redirect back with a success message
                    return redirect()->route('index.blogs')->with('success', 'blog has been created successfully');
                }
            }
        } catch (Exception $e) {
            // Handle exceptions as needed...

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred.'], 500);
            } else {
                // Redirect back with an error message
                return redirect()->route('index.blogs')->with('error', 'An error occurred.');
            }
        }
    }


    public function show($id)
    {
        session(['title' => 'Show blog']);
        $blog = Blog::find($id);
        $comments = Comment::where('blog_id', $blog->id)->get();
        return view('blogs.show', compact('blog', 'comments'));
    }


        public function edit($id)
    {
        $categories = Category::all();
        $blog = Blog::find($id);
        return view('blogs.edit', compact('categories', 'blog'));
    }



            public function update(Request $request, $id)
        {
            $request->validate([
                'category_id' => 'numeric|required',
                'name' => 'required',
                'desc' => 'required',
                'location' => 'required',
                'contact' => 'required',
                'owner' => 'required',
                'images' => 'required|array',
                'images.*' => 'required|image|mimes:pdf,jpeg,png,jpg,gif',
                
            ]);

            $blog = Blog::find($id);
            $blog->category_id = $request->category_id;
            $blog->name = $request->name;
            $blog->desc = $request->desc;
            $blog->price = $request->price;
            $blog->location = $request->location;
            $blog->size = $request->size;
            $blog->status = $request->status;
            $blog->type = $request->type;

            if ($request->hasFile('video')) {
        $videoName = time() . "." . $request->video->extension();
        $request->video->storeAs('public/videos', $videoName);
        $blog->video = url(Storage::url('videos/' . $videoName));
    }

            if (is_array($request->file('images')) || is_object($request->file('images'))) {
                $imageUrls = array();
                foreach ($request->file('images') as $image) {
                    $imageName = time() . "_" . $image->getClientOriginalName();
                    $image->storeAs('public/images', $imageName);
                    $url = Storage::url('images/' . $imageName);
                    array_push($imageUrls, $url);
                }
                $Blog->images = $imageUrls;
            }

            $blog->save();

            return redirect()->route('index.blogs')
                ->with('success', 'blog has been updated successfully.');
        }

    public function destroy(blog $blog)
        {
            $blog->delete();

            return redirect()->route('blogs.index')->with('success', 'blog has been deleted successfully');
        }


    public function search(Request $request)
    {

        $builder = Blog::query()->with('user')->withCount('comments')->orderBy('created_at', 'desc');

        $builder->where('desc', 'like', '%' . $request->input('query') . '%');

        return response()->json($builder->get());
    }

    public function editblog($id, Request $request)
    {
        $blog = Blog::findOrFail($id);

        $blog->desc = $request->desc;
        $blog->category_id = $request->category_id;
        $blog->save();

        return response()->json($blog);
    }

    public function confirmDelete($id){
        session(['title' => 'Confirm Delete']);
        $blog = Blog::find($id);
        return view('blogs.confirm_delete', compact('blog'));
    }

    public function deleteblog(Request $request)
    {
        $blog = Blog::find($request->id);

        if ($blog) {
            $blog->delete();
            return redirect()->route('blogs.index')->with('success', 'blog has been deleted successfully');
        } else {
            return redirect()->route('blogs.index')->with('error', 'blog not found');
        }

    }

}
