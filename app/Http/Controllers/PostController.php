<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Storage;
use Str;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\Utils;
use App\Models\Comment;
use App\Helpers\FCM;
use App\Models\Reply;

class PostController extends Controller
{
    protected $utils, $fcm;

    public function __construct(Utils $utils, FCM $fcm)
    {
        $this->utils = $utils;
        $this->fcm = $fcm;
    }

    public function index()
    {
        session(['title' => 'Posts']);
        $posts = Post::with('category')->withCount('comments')->orderBy('id', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function getPosts()
    {
        // Get all posts
        $posts = Post::with('user')->withCount('comments')->orderBy('created_at', 'desc')->take(15)->get();
        return response()->json($posts);
    }

    public function getPostsByCategory(Request $request)
    {

        $posts = Post::with('user')->withCount('comments')->where('category_id', $request->category_name)->orderBy('created_at')->take(15)->get();
        return response()->json($posts);
    }


    public function getPostDetails($id)
    {
        // Get a single post
        $post = Post::with('user', 'comments', 'comments.user', 'comments.replies', 'comments.replies.user')->withCount('comments')->find($id);
        return response()->json($post);
    }

    public function create()
    {
        $categories = Category::all();
         $post = new Post;
        return view('posts.create', compact('categories', 'post'));
    }


   public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'name' => 'required',
        'desc' => 'required',
        'price' => 'required',
        'location' => 'required',
        'contact' => 'required',
        'owner' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    $post = new Post;
    $post->category_id = $request->category_id;
    $post->name = $request->name;
    $post->desc = $request->desc;
    $post->price = $request->price;
    $post->location = $request->location;
    $post->size = $request->size;
    $post->status = $request->status;
    $post->type = $request->type;
    $post->bedroom = $request->bedroom;
    $post->bathroom = $request->bathroom;
    $post->contact = $request->contact;
    $post->owner = $request->owner;
    $post->user_id = $user->id; // Associate the post with the user

    if ($request->hasFile('video')) {
        $videoName = time() . "." . $request->video->extension();
        $request->video->storeAs('public/videos', $videoName);
        $post->video = url(Storage::url('videos/' . $videoName));
    }

    if ($request->hasFile('profile_pic')) {
        $imageName = time() . "." . $request->profile_pic->extension();
        $request->profile_pic->storeAs('public/profilepics', $imageName);
        $post->profile_pic = url(Storage::url('profilepics/' . $imageName));
    }

    if (is_array($request->file('images')) || is_object($request->file('images'))) {
        $imageUrls = array();
        foreach ($request->file('images') as $image) {
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $url = Storage::url('images/' . $imageName);
            array_push($imageUrls, $url);
        }
        $post->images = $imageUrls;
    }

    $post->save();

    // Include user information in the JSON response
    return response()->json([
        'message' => 'Post has been created successfully',
        'post' => $post, // Include the created post
        'user' => $user, // Include user information
    ], 201);
}


    public function show($id)
    {
        session(['title' => 'Show Post']);
        $post = Post::find($id);
        $comments = Comment::where('post_id', $post->id)->get();
        return view('posts.show', compact('post', 'comments'));
    }


        public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view('posts.edit', compact('categories', 'post'));
    }



            public function update(Request $request, $id)
        {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'desc' => 'required',
                'price' => 'required',
                'location' => 'required',
                'size' => 'required',
                'status' => 'required',
                
            ]);

            $post = Post::find($id);
            $post->category_id = $request->category_id;
            $post->name = $request->name;
            $post->desc = $request->desc;
            $post->price = $request->price;
            $post->location = $request->location;
            $post->size = $request->size;
            $post->status = $request->status;
            $post->type = $request->type;

            if ($request->hasFile('video')) {
        $videoName = time() . "." . $request->video->extension();
        $request->video->storeAs('public/videos', $videoName);
        $post->video = url(Storage::url('videos/' . $videoName));
    }

            if (is_array($request->file('images')) || is_object($request->file('images'))) {
                $imageUrls = array();
                foreach ($request->file('images') as $image) {
                    $imageName = time() . "_" . $image->getClientOriginalName();
                    $image->storeAs('public/images', $imageName);
                    $url = Storage::url('images/' . $imageName);
                    array_push($imageUrls, $url);
                }
                $post->images = $imageUrls;
            }

            $post->save();

            return redirect()->route('index.posts')
                ->with('success', 'Post has been updated successfully.');
        }

    public function destroy(Post $post)
        {
            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Post has been deleted successfully');
        }


    public function search(Request $request)
    {

        $builder = Post::query()->with('user')->withCount('comments')->orderBy('created_at', 'desc');

        $builder->where('desc', 'like', '%' . $request->input('query') . '%');

        return response()->json($builder->get());
    }

    public function editPost($id, Request $request)
    {
        $post = Post::findOrFail($id);

        $post->desc = $request->desc;
        $post->category_id = $request->category_id;
        $post->save();

        return response()->json($post);
    }

    public function confirmDelete($id){
        session(['title' => 'Confirm Delete']);
        $post = Post::find($id);
        return view('posts.confirm_delete', compact('post'));
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->id);

        if ($post) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post has been deleted successfully');
        } else {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

    }

}
