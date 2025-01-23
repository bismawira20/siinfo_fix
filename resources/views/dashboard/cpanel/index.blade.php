@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Permintaan Akses Cpanel </h1>
</div>

<div class="table-responsive small">
  @if(session()->has('success'))
  </div>
    <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    <a href="/dashboard/cpanel/create" class="btn btn-primary mb-3">Tambah Permintaan</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Pemohon</th>
          <th scope="col">No Telp</th>
          <th scope="col">Asal OPD</th>
          <th scope="col">Jabatan</th>
          <th scope="col">Aksi</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cpanel as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp}}</td>
          <td>{{ $p->asal_opd }}</td>
          <td>{{ $p->jabatan}}</td>
          <td>
            <a href="{{ route('cpanel.edit', $p->id) }}" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <form action="{{ route('cpanel.destroy', $p->id) }}" method="post" class="d-inline">
              @csrf
              @method('delete')
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                  <i class="bi bi-trash fs-6"></i></button>
            </form>
          </td>
          <td>{{ $p->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $cpanel->links() }}
  </div>
@endsection