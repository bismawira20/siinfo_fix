@extends('layouts.main')

@section('container')
    <article>
        <h1 class="mb-5">{{ $post->title }}</h1>
        <p>by <a href="/authors/{{$post->user->username}}" class="text-decoration-none">{{ $post->user->name}}</a> 
            in <a href="/categories/{{ $post->category->slug }}"  class="text-decoration-none">
                {{$post->category->name}}</a></p>
        {{-- <h5>{{ $post["author"] }}</h5> --}}
        <p>{!! $post->body !!}</p>
    </article>
    <a href="/berita" class="d-block mt-3">Kembali ke Berita</a>
@endsection
