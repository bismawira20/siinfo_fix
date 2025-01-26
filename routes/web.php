<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CpanelController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\EmailDinasController;
use App\Http\Controllers\PassphraseController;
use App\Http\Controllers\AdminBidangController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\PostDashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    $posts = Post::latest()->take(3)->get();
    return view('home',[
        "title" => 'Beranda',
        "active" => "home",
        "posts" => $posts
    ]);
});
Route::get('/profile', function () {
    return view('profile',[
        "title" => 'Profile',
        "active" => "profile",
    ]);
});
Route::get('/layanan', function () {
    return view('layanan',[
        "title" => 'Layanan',
        "active" => "layanan",
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

// Route untuk Bagian Admin
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
        Route::put('/{bukutamu}/update', [BukuTamuController::class, 'update'])->name('bukutamu.update');
        Route::get('/{bukutamu}/edit', [BukuTamuController::class, 'edit'])->name('bukutamu.edit');
    });
    //Route untuk Berita
    Route::prefix('dashboard/post')->group(function(){
        Route::get('/',[PostDashboardController::class, 'index'])->name('post.index');
        Route::get('/create',[PostDashboardController::class, 'create'])->name('post.create');
        Route::post('/store', [PostDashboardController::class, 'store'])->name('post.store');
        Route::get('/{post}/tampil',[PostDashboardController::class, 'tampil'])->name('post.tampil');
        Route::delete('/{post}/destroy',[PostDashboardController::class, 'destroy'])->name('post.destroy');
        Route::put('/{post}/update', [PostDashboardController::class, 'update'])->name('post.update');
        Route::get('/{post}/edit', [PostDashboardController::class, 'edit'])->name('post.edit');
    });
    //Route Pengaduan Masyarakat
    Route::prefix('dashboard/pengaduan')->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::delete('/{pengaduan}/destroy', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
        Route::put('/{pengaduan}/update', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::get('/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    });
    //Route untuk Pengajuan TTE
    Route::prefix('dashboard/pengajuan')->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::delete('/{pengajuan}/destroy',[PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
        Route::put('/{pengajuan}/update', [PengajuanController::class, 'update'])->name('pengajuan.update');
        Route::get('/{pengajuan}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    });
    //Route untuk Passphrase TTE
    Route::prefix('dashboard/passphrase')->group(function () {
        Route::get('/', [PassphraseController::class, 'index'])->name('passphrase.index');
        Route::get('/create', [PassphraseController::class, 'create'])->name('passphrase.create');
        Route::post('/store', [PassphraseController::class, 'store'])->name('passphrase.store');
        Route::delete('/{passphrase}/destroy',[PassphraseController::class, 'destroy'])->name('passphrase.destroy');
        Route::put('/{passphrase}/update', [PassphraseController::class, 'update'])->name('passphrase.update');
        Route::get('/{passphrase}/edit', [PassphraseController::class, 'edit'])->name('passphrase.edit');
    });
    //Route untuk CPANEL
    Route::prefix('dashboard/cpanel')->group(function () {
        Route::get('/', [CpanelController::class, 'index'])->name('cpanel.index');
        Route::get('/create', [CpanelController::class, 'create'])->name('cpanel.create');
        Route::post('/store', [CpanelController::class, 'store'])->name('cpanel.store');
        Route::delete('/{cpanel}/destroy',[CpanelController::class, 'destroy'])->name('cpanel.destroy');
        Route::put('/{cpanel}/update', [CpanelController::class, 'update'])->name('cpanel.update');
        Route::get('/{cpanel}/edit', [CpanelController::class, 'edit'])->name('cpanel.edit');
    });
    //Route Email Dinas
    Route::prefix('dashboard/emaildinas')->group(function () {
        Route::get('/', [EmailDinasController::class, 'index'])->name('emaildinas.index');
        Route::get('/create', [EmailDinasController::class, 'create'])->name('emaildinas.create');
        Route::post('/store', [EmailDinasController::class, 'store'])->name('emaildinas.store');
        Route::delete('/{emaildinas}/destroy',[EmailDinasController::class, 'destroy'])->name('emaildinas.destroy');
        Route::put('/{emaildinas}/update', [EmailDinasController::class, 'update'])->name('emaildinas.update');
        Route::get('/{emaildinas}/edit', [EmailDinasController::class, 'edit'])->name('emaildinas.edit');
    });
    //Route Aplikasi
    Route::prefix('dashboard/aplikasi')->group(function () {
        Route::get('/', [AplikasiController::class, 'index'])->name('aplikasi.index');
        Route::get('/create', [AplikasiController::class, 'create'])->name('aplikasi.create');
        Route::post('/store', [AplikasiController::class, 'store'])->name('aplikasi.store');
        Route::delete('/{aplikasi}/destroy',[AplikasiController::class, 'destroy'])->name('aplikasi.destroy');
        Route::put('/{aplikasi}/update', [AplikasiController::class, 'update'])->name('aplikasi.update');
        Route::get('/{aplikasi}/edit', [AplikasiController::class, 'edit'])->name('aplikasi.edit');
    });
    //Route Domain
    Route::prefix('dashboard/domain')->group(function () {
        Route::get('/', [DomainController::class, 'index'])->name('domain.index');
        Route::get('/create', [DomainController::class, 'create'])->name('domain.create');
        Route::post('/store', [DomainController::class, 'store'])->name('domain.store');
        Route::delete('/{domain}/destroy',[DomainController::class, 'destroy'])->name('domain.destroy');
        Route::put('/{domain}/update', [DomainController::class, 'update'])->name('domain.update');
        Route::get('/{domain}/edit', [DomainController::class, 'edit'])->name('domain.edit');
    });
});

Route::middleware(['auth', IsAdmin::class])->group(function (){
    // Route untuk Buku Tamu  
    Route::prefix('dashboard/bukutamu/admin')->group(function () {
        Route::get('/',[BukuTamuController::class, 'adminIndex'])->name('bukutamu.admin.index');
        Route::put('/{bukutamu}/setuju',[BukuTamuController::class,'setuju'])->name('bukutamu.admin.setuju');
        Route::put('/{bukutamu}/tolak',[BukuTamuController::class,'tolak'])->name('bukutamu.admin.tolak');
        Route::put('/setujuSemua',[BukuTamuController::class,'setujuSemua'])->name('bukutamu.admin.setujuSemua');
    });
    //Route untuk Berita
    Route::prefix('dashboard/post/admin')->group(function(){
        Route::get('/',[PostDashboardController::class, 'adminIndex'])->name('post.admin.index');
        Route::get('/create',[PostDashboardController::class, 'adminCreate'])->name('post.admin.create');
        Route::post('/store', [PostDashboardController::class, 'adminStore'])->name('post.admin.store');
        Route::get('/{post}/show',[PostDashboardController::class, 'adminShow'])->name('post.admin.show');
        Route::delete('/{post}/destroy',[PostDashboardController::class, 'adminDestroy'])->name('post.admin.destroy');
        Route::put('/{post}/update', [PostDashboardController::class, 'adminUpdate'])->name('post.admin.update');
        Route::get('/{post}/edit', [PostDashboardController::class, 'adminEdit'])->name('post.admin.edit');
    });
    //Route untuk Pengaduan
    Route::prefix('dashboard/pengaduan/admin')->group(function(){
        Route::get('/',[PengaduanController::class, 'adminIndex'])->name('pengaduan.admin.index');
        Route::get('/{pengaduan}/tanggapi',[PengaduanController::class, 'adminTanggapi'])->name('pengaduan.admin.tanggapi');
        Route::put('/{pengaduan}/update', [PengaduanController::class, 'adminUpdate'])->name('pengaduan.admin.update');
        Route::put('/{pengaduan}/setuju',[PengaduanController::class,'setuju'])->name('pengaduan.admin.setuju');
        Route::put('/{pengaduan}/tolak',[PengaduanController::class,'tolak'])->name('pengaduan.admin.tolak');
        Route::put('/setujuSemua',[PengaduanController::class,'setujuSemua'])->name('pengaduan.admin.setujuSemua');
    });
    //Route Pengajuan TTE
    Route::prefix('dashboard/pengajuan/admin')->group(function () {
        Route::get('/',[PengajuanController::class, 'adminIndex'])->name('pengajuan.admin.index');
        Route::put('/{pengajuan}/selesai',[PengajuanController::class,'selesai'])->name('pengajuan.admin.selesai');
        Route::put('/selesaiSemua',[PengajuanController::class,'selesaiSemua'])->name('pengajuan.admin.selesaiSemua');
    });
    //Route untuk Passphrase TTE
    Route::prefix('dashboard/passphrase/admin')->group(function () {
        Route::get('/',[PassphraseController::class, 'adminIndex'])->name('passphrase.admin.index');
        Route::put('/{passphrase}/selesai',[PassphraseController::class,'selesai'])->name('passphrase.admin.selesai');
        Route::put('/selesaiSemua',[PassphraseController::class,'selesaiSemua'])->name('passphrase.admin.selesaiSemua');
    });
    //Route untuk CPANEL
    Route::prefix('dashboard/cpanel/admin')->group(function () {
        Route::get('/',[CpanelController::class, 'adminIndex'])->name('cpanel.admin.index');
        Route::put('/{cpanel}/selesai',[CpanelController::class,'selesai'])->name('cpanel.admin.selesai');
        Route::put('/selesaiSemua',[CpanelController::class,'selesaiSemua'])->name('cpanel.admin.selesaiSemua');
    });
    //Route untuk EmailDinas
    Route::prefix('dashboard/emaildinas/admin')->group(function () {
        Route::get('/',[EmailDinasController::class, 'adminIndex'])->name('emaildinas.admin.index');
        Route::put('/{emaildinas}/selesai',[EmailDinasController::class,'selesai'])->name('emaildinas.admin.selesai');
        Route::put('/selesaiSemua',[EmailDinasController::class,'selesaiSemua'])->name('emaildinas.admin.selesaiSemua');
    });
    //Route untuk Aplikasi
    Route::prefix('dashboard/aplikasi/admin')->group(function () {
        Route::get('/',[AplikasiController::class, 'adminIndex'])->name('aplikasi.admin.index');
        Route::get('/{aplikasi}/show',[AplikasiController::class, 'adminShow'])->name('aplikasi.admin.show');
        Route::put('/{aplikasi}/selesai',[AplikasiController::class,'selesai'])->name('aplikasi.admin.selesai');
        Route::put('/selesaiSemua',[AplikasiController::class,'selesaiSemua'])->name('aplikasi.admin.selesaiSemua');
    });
    //Route untuk Domain
    Route::prefix('dashboard/domain/admin')->group(function () {
        Route::get('/',[DomainController::class, 'adminIndex'])->name('domain.admin.index');
        Route::get('/{domain}/show',[DomainController::class, 'adminShow'])->name('domain.admin.show');
        Route::put('/{domain}/selesai',[DomainController::class,'selesai'])->name('domain.admin.selesai');
        Route::put('/selesaiSemua',[DomainController::class,'selesaiSemua'])->name('domain.admin.selesaiSemua');
    });
});

