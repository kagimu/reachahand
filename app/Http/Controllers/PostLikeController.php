<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Request $request)
{
   $validatedData = $request->validate([
       'user_id' => 'required|integer',
       'post_id' => 'required|integer'
   ]);

   $likedPost = LikedPost::create([
       'user_id' => $validatedData['user_id'],
       'post_id' => $validatedData['post_id']
   ]);

   if ($likedPost) {
       return response()->json(['success' => true]);
   } else {
       return response()->json(['success' => false]);
   }
}
}