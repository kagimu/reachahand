<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $posts = Post::withCount('comments')->orderBy('id', 'desc')->get();
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

        $posts = Post::with('user')->withCount('comments')->where('category_id', $request->category_id)->orderBy('created_at', 'desc')->take(15)->get();
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
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'location' => 'required',
            'size' => 'required',
            'status' => 'required',
            'type' => 'required',
            'user_id' => 'required',
        ]);

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->desc = $request->desc;
        $post->price = $request->price;
        $post->location = $request->location;
        $post->size = $request->size;
        $post->status = $request->status;
        $post->type = $request->type;
        $post->user_id = $request->user_id;
        $post->created = $request->created;
        $post->date = $this->utils->getCurrentDate();
        $post->user_id = Auth::id();
        $array = array();
        if (is_array($request->file('images')) || is_object($request->file('images'))) {
            foreach ($request->file('images') as $image) {
                $str = Str::random(30);
                $uniqueFileName = $str . "." . $image->getClientOriginalExtension();
                $url = url(Storage::url($image->storeAs('/posts', $uniqueFileName, 'public')));
                array_push($array, $url);
            }
        }

        $post->images = $array;
        $post->save();

        // FCM notification
        $this->fcm->newPost(Auth::user());

        return response()->json($post);
    }


    public function show($id)
    {
        session(['title' => 'Show Post']);
        $post = Post::find($id);
        $comments = Comment::where('post_id', $post->id)->get();
        return view('posts.show', compact('post', 'comments'));
    }


    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post, $id)
    {

        $request->validate([
            'token' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'location' => 'required',
            'size' => 'required',
            'status' => 'required',
            'type' => 'required',

        ]);

        $post = Post::find($id);
        $post->token = $request->token;
        $post->category_id = $request->category_id;
        $post->desc = $request->desc;
        $post->price = $request->price;
        $post->location = $request->location;
        $post->size = $request->size;
        $post->status = $request->status;
        $post->type = $request->type;
        $array = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $str = Str::random(30);
                $uniqueFileName = $str . "." . $image->getClientOriginalExtension();
                $url = url(Storage::url($image->storeAs('/posts', $uniqueFileName, 'public')));
                array_push($array, $url);

            }
        }

        $post->images = $array;
        $post->save();
        return response()->json($post);


        return redirect()->route('posts.index')
            ->with('success', 'Post has been created successfully.');
    }


    public function destroy(Post $post, $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post has been deleted successfully');
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

        $post->desc = $request->caption;
//        $post->category_id = $request->category_id;
        $post->save();

        return response()->json($post);
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->post_id);
        $comments = Comment::where('post_id', $post->id)->get();
        foreach ($comments as $c) {
            $replies = Reply::where('comment_id', $c->id)->get();
            foreach ($replies as $r) {
                $r->delete();
            }
            $c->delete();
        }
        $post->delete();

        return response()->json(['code' => 1, 'message' => 'Post deleted successfully']);
    }

}
