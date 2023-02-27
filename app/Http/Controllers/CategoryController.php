<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Comment;

class CategoryController extends Controller
{
    public function index()
    {
        session(['title' => 'Categories']);
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        session(['title' => 'Create Category']);

        $category = new Category();

        return view('categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $message = "Category has been updated successfully";
        } else {
            $category = new Category();
            $message = "Category has been created successfully";

        }
        $category->category_name = $request->category_name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->storeAs('public/categories', $imageName);
            $category->image = url(Storage::url('categories/' . $imageName));
        }

        $category->save();

        return redirect()->route('index.categories')
            ->with('message', $message);
    }


    public function edit($id)
    {
        session(['title' => 'Edit Category']);

        $category = Category::find($id);

        return view('categories.create', compact('category'));
    }


    public function confirmDelete($id){
        session(['title' => 'Confirm Delete']);
        $category = Category::find($id);
        return view('categories.confirm_delete', compact('category'));
    }

    public function delete(Request $request){
        $category = Category::find($request->id);

        $posts = Post::where('category_id', $category->id)->get();
        foreach ($posts as $post){
            $comments = Comment::where('post_id', $post->id)->get();
            foreach ($comments as $c){
                $replies = Reply::where('comment_id', $c->id)->get();
                foreach($replies as $r){
                    $r->delete();
                }
                $c->delete();
            }
            $post->delete();
        }

        $category->delete();

        return redirect()->route('index.categories');
    }


    public function getCategories()
    {

        $categories = Category::get();

        return response()->json($categories);
    }

    public function getCategory($id)
    {
        // Get a single category
        $category = Category::find($id);
        return response()->json($category);
    }


    public function show($category_id)
    {
        $category = Category::find($category_id);
        $faqs = Faq::where('category_id', $category_id)->get();

        return view('categories.show', compact('category'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $category = Category::find($id);
        $category->category_name = is_null($request->category_name) ? $category->category_name : $request->category_name;
        $category->description = is_null($request->description) ? $category->description : $request->description;

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $category['image'] = "$profileImage";
        }

        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category Has Been updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category has been deleted successfully');
    }
}


