@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                    <h1 class="mb-3">{{ $post->title }}</h1>
                    <p>by <a href="/authors/{{$post->user->username}}" class="text-decoration-none">{{ $post->user->name}}</a> 
                        in <a href="/categories/{{ $post->category->slug }}"  class="text-decoration-none">
                            {{$post->category->name}}</a></p>
                    {{-- <h5>{{ $post["author"] }}</h5> --}}
                    <image src = https://th.bing.com/th/id/OIP.O5ZhPx6rW1FRKx6o2pXgvAHaCe?w=314&h=116&c=7&r=0&o=5&dpr=1.5&pid=1.7"
                    alt="{{ $post->category->name }}" class="img-fluid"></image>
                    
                    <article class="my-3 fs-6">
                        <p>{!! $post->body !!}</p>
                    </article>
                <a href="/berita" class="d-block mt-3 text-decoration-none">Kembali ke Berita</a>
            </div>
        </div>
    </div>
@endsection
