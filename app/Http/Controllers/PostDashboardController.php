<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostDashboardController extends Controller
{
    public function index(){
        // return 'uji';
        $posts = Post::where('user_id', Auth::id())
                         ->with('category') // Tambahkan eager loading
                         ->paginate(10);
        return view('dashboard.post.index', compact('posts'));
    }

    public function create(){
        return view('dashboard.post.create',[
            'categories' =>Category::all()
        ]);
    }

    public function store(Request $request){
        return $request;
    }

    public function adminIndex(){
        $posts = Post::paginate(10);
        return view('dashboard.post.admin.index', compact('posts'));
    }

    public function adminShow(Post $post){
        return view('dashboard.post.admin.show',[
            'post' => $post
        ]);
    }

    public function adminCreate(){
        return view('dashboard.post.admin.create',[
            'categories' =>Category::all()
        ]);
    }

    public function adminStore(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' =>'required',
            'body' => 'required'
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::create($validatedData);

        return redirect('/dashboard/post/admin')->with("success", "Berita berhasil ditambahkan!");
    }

    public function adminDestroy(Post $post){
        Post::destroy($post->id);
        return redirect('/dashboard/post/admin')->with("success", "Berita berhasil dihapus!");

    }

    public function adminEdit(Post $post){
        return view('dashboard.post.admin.edit',[
            'post' => $post,
            'categories' =>Category::all()
        ]);
    }

    public function adminUpdate(Request $request, Post $post){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' =>'required',
            'body' => 'required'
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/post/admin')->with("success", "Berita berhasil diupdate!");
    }
}
