<?php

use App\Http\Controllers\DashboardController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home',[
        "title" => 'Home',
        "active" => "home",
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => 'About',
        "active" => "about",
    ]);
});


Route::get('/berita', [PostController::class,'index']);

//halaman single post
Route::get('posts/{post:slug}',  [PostController::class,'show']);

Route::get('/categories', function(){
    return view('categories',[
        "title" => 'Kategori Berita',
        "active"=> 'categories',
        "categories" => Category::all(),
    ]);
});

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/register',[RegisterController::class,'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/dashboard',function(){
    return view('dashboard.index');
})->middleware('auth');

// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('berita',[
//         "title" => "Kategori Berita : $category->name",
//         "posts" => $category->posts->load('category','user'),
//         "active" => 'category',
//         // "category" => $category->name,
//     ]);
// });

// Route::get('/authors/{user:username}', function(User $user){
//     return view('berita',[
//         "title" => "Berita oleh : $user->name",
//         "posts" => $user->posts->load('category','user'),
//         "active" => 'berita',
//     ]);
// });

