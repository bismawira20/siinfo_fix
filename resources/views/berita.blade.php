@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/berita">
                @if (request('category'))
                <input type="hidden"  name ="category" value="{{ request('category') }}">
                @endif
                @if (request('user'))
                <input type="hidden"  name ="user" value="{{ request('user') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari" name ="search">
                    <button class="btn btn-danger" type="submit" style="margin-left: 5px;">Cari</button>
                </div>
            </form>
        </div>
    </div>   

    @if ($posts->count())
        <div class="card mb-3">

            @if ($posts[0]->image)
            <div style="max-height: 350px; overflow:hidden">
              <image src = "{{ asset('storage/'. $posts[0]->image) }}"
              alt="{{ $posts[0]->category->name }}" class="img-fluid"></image>
            </div>
            @else
            <img src="https://picsum.photos/1200/400"
            class="card-img-top" alt="{{ $posts[0]->category->name }}">
            @endif


            <div class="card-body text-center">
                <a href="/posts/{{$posts[0]->slug}}" class="text-decoration-none text-dark">
                <h3 class="card-title">{{ $posts[0]->title }}</h3>
                </a>
                <p>
                    <small class="text-body-secondary">
                    by <a href="/berita?authors={{$posts[0]->user->username}}" class="text-decoration-none"> 
                    {{$posts[0]->user->name}}</a> in 
                    <a href="/berita?category={{ $posts[0]->category->slug }}" class="text-decoration-none">
                    {{$posts[0]->category->name}}</a>
                    {{ $posts[0]->created_at->format('d F Y') }}
                    </small>
                </p>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <a href="/posts/{{$posts[0]->slug}}" class="text-decoration-none btn btn-danger" >Baca selanjutnya</a>
            </div>
        </div>  
        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute bg-dark px-3 py-2 text-white" 
                        style="background-color :rgba(0, 0, 0, 0.7)">
                        <a href="/berita?category={{ $post->category->slug }}" class="text-white text-decoration-none">
                            {{ $post->category->name }}
                        </a>
                        </div>

                        @if ($post->image)
                          <image src = "{{ asset('storage/'. $post->image) }}"
                          alt="{{ $post->category->name }}" class="img-fluid"></image>
                        @else
                        <img src="https://picsum.photos/500/500"
                        class="card-img-top" alt="{{ $post->category->name }}">
                        @endif

                        <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p>
                            <small class="text-body-secondary">
                            by <a href="/berita?authors={{$post->user->username}}" class="text-decoration-none"> 
                            {{$post->user->name}}</a>
                            {{ $post->created_at->format('d F Y') }}
                            </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/posts/{{$post->slug}}" class="btn btn-danger">Baca Selanjutnya</a>
                        </div>
                    </div>
                </div>     
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">Tidak Ada Berita</p>
    @endif

<div class="d-flex justify-content-end">
    {{ $posts->links() }}
</div>
@endsection