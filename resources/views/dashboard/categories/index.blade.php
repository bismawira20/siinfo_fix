@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Tambah Kategori</h1>
</div>
@if(session()->has('success'))
  </div>
  <div class="alert alert-success" role="alert">
    {{ session(success) }}
  </div>
@endif
<div class="table-responsive small col-lg-6">
    <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Tambah Kategori Berita</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Kategori</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <a href="" class="badge bg-danger"><i class="bi bi-trash fs-6"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection