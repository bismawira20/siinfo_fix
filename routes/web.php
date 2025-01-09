<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home',[
        "title" => 'Home',
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => 'About',
    ]);
});


Route::get('/berita', [PostController::class,'index']);

//halaman single post
Route::get('posts/{post:slug}',  [PostController::class,'show']);

Route::get('/categories', function(){
    return view('categories',[
        "title" => 'Kategori Berita',
        "categories" => Category::all(),
    ]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    return view('berita',[
        "title" => "Kategori Berita : $category->name",
        "posts" => $category->posts,
        "category" => $category->name,
    ]);
});

Route::get('/authors/{user:username}', function(User $user){
    return view('berita',[
        "title" => "Berita oleh : $user->name",
        "posts" => $user->posts,
    ]);
});

