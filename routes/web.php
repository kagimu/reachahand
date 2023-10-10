<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostLikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/users/clients', [UserController::class, 'index_clients'])->name('index.clients');
    Route::get('/users/support', [UserController::class, 'index_support'])->name('index.support');
    Route::get('/users/activate/{id}', [UserController::class, 'activate'])->name('activate.user');

    Route::get('/agents', [AgentController::class, 'index'])->name('index.agents');
    Route::get('/agents/create', [AgentController::class, 'create'])->name('create.agents');
    Route::post('/agents/store', [AgentController::class, 'store'])->name('store.agents');
    Route::get('/agents/edit/{id}', [AgentController::class, 'edit'])->name('edit.agents');

    Route::get('/categories', [CategoryController::class, 'index'])->name('index.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('create.categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('store.categories');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('edit.categories');
    Route::get('/categories/confirm-delete/{id}', [CategoryController::class, 'confirmDelete'])->name('confirm_delete.categories');
    Route::post('/categories/delete', [CategoryController::class, 'delete'])->name('delete.categories');

    Route::get('/posts', [PostController::class, 'index'])->name('index.posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create.posts');
    Route::post('/posts/store', [PostController::class, 'store'])->name('store.posts');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('edit.posts');
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('show.posts');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update.posts');
    Route::get('/posts/confirm-delete/{id}', [PostController::class, 'confirmDelete'])->name('confirm_delete.POSTS');
    Route::get('/posts/deletePost', [PostController::class, 'deletePost'])->name('deletePost.posts');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('index.settings');
    Route::post('/settings/store', [SettingsController::class, 'store'])->name('store.settings');

    Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
    Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

});



//ROUTES FOR POST CONTROLLER

Route::get('/index', [PostController::class,'create'])->name('posts.index');
Route::get('/create', [PostController::class,'create'])->name('posts.create');

Route::post('/store', [PostController::class,'store'])->name('posts.store');

Route::get('/show/{post:desc}', [PostController::class,'show'])->name('posts.show');

Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');

Route::post('/reply/store', [CommentController::class,'replyStore'])->name('reply.add');

Route::get('/delete/{id}', [PostController::class, 'destroy']);




//ROUTES FOR COMMENT CONTROLLER

Route::post('/posts/{post}/comments ', [CommentController::class, 'store']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





