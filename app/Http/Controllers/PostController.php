<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('berita', [
            'title' => 'Berita',
            'active' =>'berita',
            //'posts' => Post::all(),
            'posts' => Post::latest()->filter(request(['search','category','user']))
            ->paginate(7)->withQueryString(),
        ]);
    }
    public function show(Post $post){
        return view('post',[
            "title" => "Single Post",
            'active' =>'berita',
            "post" => $post
        ]);
    }
}