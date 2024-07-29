<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        session(['title' => 'Programs']);
        $programs = Program::get();

        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        session(['title' => 'Create Program']);

        $program = new Program();

        return view('programs.create', compact('program'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'cover_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add validation rules for other fields like logo if needed
        ]);

        try {
            $program = new Program();
            $program->title = $request->title;
            $program->desc = $request->desc;
            $program->category = $request->category;

            if ($request->hasFile('cover_pic')) {
                $imageFile = $request->file('cover_pic');
                $imageExt = $imageFile->getClientOriginalExtension();
                $imageName = time().'_'.$imageExt;
                $imagePath = $imageFile->storeAs('programs/cover_pic', $imageName, 'public');
                $program->cover_pic = $imagePath;
            }

            if ($request->hasFile('logo')) {
                $imageFile = $request->file('logo');
                $imageExt = $imageFile->getClientOriginalExtension();
                $imageName = time().'_'.$imageExt;
                $imagePath = $imageFile->storeAs('programs/logo', $imageName, 'public');
                $program->logo = $imagePath;
            }

            if ($request->hasFile('gallery_images')) {
                $gallery_images = [];
                foreach ($request->file('gallery_images') as $index => $file) {
                    $file_extension = $file->getClientOriginalExtension();
                    $file_name = time().'_'.$index.'.'.$file_extension;
                    $file_path = $file->storeAs('images/programs/gallery_images', $file_name, 'public');
                    array_push($gallery_images, $file_path);
                }
                $program->gallery_images = $gallery_images;
            }
            $program->save();

            if ($request->ajax()) {
                // Return JSON response with programs information
                return response()->json([
                    'message' => 'Program has been created successfully',
                    'program' => $program,
                ], 200);
            } else {
                // Redirect back with a success message
                return redirect()->route('index.programs')->with('success', 'Program has been created successfully');
            }
        } catch (Exception $e) {
            // Handle exceptions as needed...

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred.'], 500);
            } else {
                // Redirect back with an error message
                return redirect()->route('index.programs')->with('error', 'An error occurred.');
            }
        }
    }

    public function edit($id)
    {
        session(['title' => 'Edit Program']);

        $program = Program::find($id);

        return view('programs.edit', compact('program'));
    }

    public function getPrograms()
    {
        $programs = Program::get();

        return response()->json($programs);
    }

    public function search(Request $request)
    {
        $builder = Program::query()->with('program_name');
        $builder->where('program_name', '%'.$request->input('query').'%');

        return response()->json($builder->get());
    }

    public function getProgram($id)
    {
        // Get a single category
        $program = Program::find($id);

        return response()->json($program);
    }

    public function show($category_id)
    {
        $program = Program::find($category_id);

        return view('programs.show', compact('program'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_name' => 'required',
            'phone' => 'required',
            'cover_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add validation rules for other fields like logo if needed
        ]);

        try {
            $program = Program::find($id);
            $program->title = $request->title;
            $program->desc = $request->desc;
            $program->category = $request->category;

            if ($request->hasFile('cover_pic')) {
                $imageFile = $request->file('cover_pic');
                $imageExt = $imageFile->getClientOriginalExtension();
                $imageName = time().'_'.$imageExt;
                $imagePath = $imageFile->storeAs('programs/cover_pic', $imageName, 'public');
                $program->cover_pic = $imagePath;
            }

            if ($request->hasFile('logo')) {
                $imageFile = $request->file('logo');
                $imageExt = $imageFile->getClientOriginalExtension();
                $imageName = time().'_'.$imageExt;
                $imagePath = $imageFile->storeAs('programs/logo', $imageName, 'public');
                $program->logo = $imagePath;
            }

            if ($request->hasFile('gallery_images')) {
                $gallery_images = [];
                foreach ($request->file('gallery_images') as $index => $file) {
                    $file_extension = $file->getClientOriginalExtension();
                    $file_name = time().'_'.$index.'.'.$file_extension;
                    $file_path = $file->storeAs('images/programs/gallery_images', $file_name, 'public');
                    array_push($gallery_images, $file_path);
                }
                $program->gallery_images = $gallery_images;
            }
            $program->save();

            if ($request->ajax()) {
                // Return JSON response with programs information
                return response()->json([
                    'message' => 'Program has been created successfully',
                    'program' => $program,
                ], 200);
            } else {
                // Redirect back with a success message
                return redirect()->route('index.programs')->with('success', 'Program has been created successfully');
            }
        } catch (Exception $e) {
            // Handle exceptions as needed...

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred.'], 500);
            } else {
                // Redirect back with an error message
                return redirect()->route('index.programs')->with('error', 'An error occurred.');
            }
        }
    }

    public function confirmDelete($id)
    {
        session(['title' => 'Confirm Delete']);
        $program = Program::find($id);

        return view('programs.confirm_delete', compact('program'));
    }

    public function deleteProgram(Request $request)
    {
        $program = Program::find($request->id);

        if ($program) {
            $program->delete();

            return redirect()->route('index.programs')->with('success', 'Program has been deleted successfully');
        } else {
            return redirect()->route('index.programs')->with('error', 'Program not found');
        }

    }
}
