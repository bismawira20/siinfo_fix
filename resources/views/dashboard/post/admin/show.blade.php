@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Berita SI-INFO</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
              <h1 class="mb-3">{{ $post->title }}</h1>
            
              <a href="/dashboard/post/admin" class="btn btn-success">Kembali ke Berita</a>
              <a href="" class="btn btn-warning">Edit</a>
              <a href="" class="btn btn-danger">Delete</a>

              <image src = "https://picsum.photos/1200/400"
              alt="{{ $post->category->name }}" class="img-fluid mt-3"></image>
              
              <article class="my-3 fs-6">
                  <p>{!! $post->body !!}</p>
              </article>
          <a href="/berita" class="d-block mt-3 text-decoration-none">Kembali ke Berita</a>
      </div>
  </div>
</div>
@endsection