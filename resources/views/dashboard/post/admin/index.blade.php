@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Berita SI-INFO</h1>
</div>

<div class="table-responsive small col-lg-10">
  @if(session()->has('success'))
  </div>
    <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    <a href="/dashboard/post/admin/create" class="btn btn-primary mb-3">Buat Berita</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Judul</th>
          <th scope="col">Kategori</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td>
            <a href="{{ route('post.admin.show', $post->id) }}" class="badge bg-primary mx-1"><i class="bi bi-eye fs-6"></i>
            <a href="{{ route('post.admin.edit', $post->id) }}" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <form action="{{ route('post.admin.destroy', $post->id) }}" method="post" class="d-inline">
              @csrf
              @method('delete')
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                  <i class="bi bi-trash fs-6"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      {{ $posts->links() }}
    </div>
  </div>
@endsection