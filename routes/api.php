<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//ROUTES FOR API
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ROUTES FOR API

Route::post('register', [UserController::class, 'registerClient']);

Route::post('login', [UserController::class, 'loginUserExample']);

Route::get('getAgents', [AgentController::class, 'getAgents']);

Route::post('registerSupport', [UserController::class, 'registerSupport']);

//add this middleware to ensure that every request is authenticated
Route::middleware('auth:api')->group(function () {

    Route::get('/profile', [UserController::class, 'getProfile']);

    Route::post('/profile/update', [UserController::class, 'updateProfile']);

    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);

    Route::post('/updateFCMToken', [UserController::class, 'updateFCMToken']);

    Route::post('/posts/{id}/like', [\App\Http\Controllers\PostLikeController::class, 'store']);

    Route::get('/posts', [PostController::class, 'getPosts']);

    Route::get('/posts/search', [PostController::class, 'search']);

    Route::get('/posts/{id}', [PostController::class, 'getPostDetails']);
    Route::post('/posts', [PostController::class, 'store']);

    Route::post('/posts/{id}/edit', [PostController::class, 'editPost']);
    Route::delete('/posts/delete', [PostController::class, 'deletePost']);
    Route::post('posts/comment', [CommentController::class, 'store']);


    Route::post('/blogs/{id}/like', [PostLikeController::class, 'store']);

    Route::get('/blogs', [BlogController::class, 'getBlogs']);

    Route::get('/blogs/search', [BlogController::class, 'search']);

    Route::get('/blogs/{id}', [BlogController::class, 'getBlogDetails']);
    Route::post('/blogs', [BlogController::class, 'store']);

    Route::post('/blogs/{id}/edit', [BlogController::class, 'editBlog']);
    Route::delete('/blogs/delete', [BlogController::class, 'deleteBlog']);
    Route::post('blogs/comment', [CommentController::class, 'store']);


    Route::get('/impacts', [ImpactController::class, 'getImpacts']);

    Route::get('/impacts/search', [ImpactController::class, 'search']);

    Route::get('/impacts/{id}', [ImpactController::class, 'getImpactDetails']);
    Route::post('/impacts', [ImpactController::class, 'store']);

    Route::post('/impacts/{id}/edit', [ImpactController::class, 'editImpact']);
    Route::delete('/impacts/delete', [ImpactController::class, 'deleteImpact']);
    Route::post('impacts/comment', [CommentController::class, 'store']);

    



     Route::get('/agents', [AgentController::class, 'getAgents']);

    Route::get('/agents/search', [AgentController::class, 'search']);

    Route::get('/agents/{id}', [AgentController::class, 'getAgent']);
 

    Route::get('comments/{id}/show', [CommentController::class, 'getComment']);
    Route::post('comments/{id}/edit', [CommentController::class, 'editComment']);
    Route::delete('comments/delete', [CommentController::class, 'deleteComment']);

    Route::post('comments/reply', [CommentController::class, 'reply']);
    Route::delete('replies/delete', [CommentController::class, 'deleteReply']);

    Route::delete('/delete/{id}', [PostController::class, 'destroy']);

    Route::put('/category/{id}/faq', [faqController::class, 'update']);

    Route::get('/category/{id}/faq', [faqController::class, 'getFaq']);
    Route::get('/faqByCategory', [faqController::class, 'getFaqsByCategory']);
    Route::post('category/{id}/faq', [faqController::class, 'store']);

    
});
Route::post('/createCategory', [CategoryController::class, 'store']);
Route::get('getCategories', [CategoryController::class, 'getCategories']);

Route::get('/getCategory/{id}', [CategoryController::class, 'getCategory']);

Route::prefix('guest')->group(function () {
    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/posts/search', [PostController::class, 'search']);
    Route::get('/posts/{id}', [PostController::class, 'getPostDetails']);
});

Route::get('/postsByCategory', [PostController::class, 'getPostsByCategory']);
Route::post('/forgotPassword', [UserController::class, 'forgotPassword']);
Route::post('/verifyCode', [UserController::class, 'verifyCode']);
Route::post('/resetPassword', [UserController::class, 'resetPassword']);
Route::get('getSettings', [SettingsController::class, 'getSettings']);

