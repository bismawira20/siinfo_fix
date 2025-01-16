@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                    <h1 class="mb-3">{{ $post->title }}</h1>
                    <p>by <a href="/berita?authors={{$post->user->username}}" class="text-decoration-none">{{ $post->user->name}}</a> 
                        in <a href="/berita?category={{ $post->category->slug }}"  class="text-decoration-none">
                            {{$post->category->name}}</a></p>
                    {{-- <h5>{{ $post["author"] }}</h5> --}}
                    @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden">
                      <image src = "{{ asset('storage/'. $post->image) }}"
                      alt="{{ $post->category->name }}" class="img-fluid"></image>
                    </div>
                    @else
                    <image src = "https://picsum.photos/1200/400"
                    alt="{{ $post->category->name }}" class="img-fluid mt-3"></image>
                    @endif
                    
                    <article class="my-3 fs-6">
                        <p>{!! $post->body !!}</p>
                    </article>
                <a href="/berita" class="d-block mt-3 text-decoration-none">Kembali ke Berita</a>
            </div>
        </div>
    </div>
@endsection
