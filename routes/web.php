<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminBidangController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Middleware\IsUser;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('dashboard.index');})->middleware('auth');

Route::middleware(IsAdmin::class)->resource('/dashboard/categories', AdminCategoryController::class)
->except('show');    
Route::middleware(IsAdmin::class)->resource('/dashboard/bidangs', AdminBidangController::class)
->except('show');
   
Route::middleware(['auth', IsUser::class])->group(function () {
    // Route untuk Buku Tamu
    Route::prefix('dashboard/bukutamu')->group(function () {
        Route::get('/', [BukuTamuController::class, 'index'])->name('bukutamu.index');
        Route::get('/create', [BukuTamuController::class, 'create'])->name('bukutamu.create');
        Route::post('/store', [BukuTamuController::class, 'store'])->name('bukutamu.store');
        Route::delete('/{bukutamu}/destroy', [BukuTamuController::class, 'destroy'])->name('bukutamu.destroy');
        Route::get('/{bukutamu}/edit', [BukuTamuController::class, 'edit'])->name('bukutamu.edit');
        Route::put('/{bukutamu}/update', [BukuTamuController::class, 'update'])->name('bukutamu.update');
    });
});

// Route::middleware(IsUser::class)->get('/dashboard/bukutamu', [BukuTamuController::class,'index']);
// Route::middleware(IsUser::class)->get('/dashboard/bukutamu/create', [BukuTamuController::class,'create']);
// Route::middleware(IsUser::class)->post('/dashboard/bukutamu/store', [BukuTamuController::class,'store']);
// Route::middleware(IsUser::class)->delete('/dashboard/bukutamu/destroy', [BukuTamuController::class,'destroy']);



// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');
// });

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

