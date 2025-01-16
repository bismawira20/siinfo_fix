@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Berita SI-INFO</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
              <h1 class="mb-3">{{ $post->title }}</h1>
            
              <a href="/dashboard/post/admin" class="btn btn-success border-0 text-white"><i class="bi bi-arrow-left fs-6"></i></a>
              <a href="{{ route('post.admin.edit', $post->id) }}" class="btn btn-warning border-0 text-white"><i class="bi bi-pencil-square fs-6"></i></a>
              <form action="{{ route('post.admin.destroy', $post->id) }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                  <button class="btn btn-danger border-0" onclick="return confirm('Anda yakin?')">
                    <i class="bi bi-trash fs-6"></i></button>
              </form>

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