<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use App\Models\Reply;

class CommentController extends Controller
{

    public function getComment($id){
        $comment = Comment::with('user', 'replies', 'replies.user')->find($id);

        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->save();

        return response()->json($comment);
    }

    public function reply(Request $request){
        $reply = new Reply();
        $reply->reply = $request->reply;
        $reply->user_id = Auth::id();
        $reply->comment_id = $request->comment_id;
        $reply->save();

        return response()->json($reply);
    }

    public function editComment($id, Request $request){
        $comment = Comment::findOrFail($id);

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment);
    }

    public function deleteComment(Request $request){
        $comment = Comment::find($request->comment_id);
        $replies = Reply::where('comment_id', $comment->id)->get();
        foreach($replies as $r){
            $r->delete();
        }
        $comment->delete();

        return response()->json(['code'=>1, 'message'=>'Comment deleted successfully']);
    }

    public function deleteReply(Request $request){
        $reply = Reply::findOrFail($request->reply_id);
        $reply->delete();

        return response()->json(['code'=>1, 'message'=>'Reply deleted successfully']);


    }

    public function update(Request $request, $id){

        if (Comment::where('id', $id)->exists()) {
            $comment = Comment::find($id);
            $comment->comment = is_null($request->comment) ? $comment->comment : $request->comment;
            $comment->token = is_null($request->token) ? $comment->token : $request->token;
            $comment->parent_id = is_null($request->parent_id) ? $comment->parent_id : $request->parent_id;
            $comment->user()->associate($request->user());
             $post = Post::find($request->post_id);
            $post->comments()->save($comment);

            return response()->json([
                "message" => "Comment updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Comment failed to be updated"
            ], 404);
        }
    }


    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->comment;
        $reply->token = $request->token;
      //  $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $post = Post::find($request->post_id);

        $post->comments()->save($reply);

        return back();

    }

}
