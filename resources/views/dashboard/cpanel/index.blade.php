@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Permintaan Akses Cpanel </h1>
</div>


<div class="">
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
</div>

<div class="table-responsive small">
    <a href="/dashboard/cpanel/create" class="btn btn-primary mb-3">Tambah Permintaan</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Pemohon</th>
          <th scope="col">No Telp</th>
          <th scope="col">URL</th>
          <th scope="col">Tanggapan Admin</th>
          {{-- <th scope="col">Aksi</th> --}}
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cpanel as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp}}</td>
          <td>{{ $p->url}}</td>
          <td>{{ $p->tanggapan}}</td>
          {{-- <td>
            @if($p->created_at->diffInHours() < 1 && $p->status == 'diproses')
            <a href="{{ route('cpanel.edit', $p->id) }}" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <form action="{{ route('cpanel.destroy', $p->id) }}" method="post" class="d-inline">
              @csrf
              @method('delete')
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                  <i class="bi bi-trash fs-6"></i></button>
            </form>
            @endif
          </td> --}}
          <td>              
            <span class="badge {{ 
            $p->status == 'diproses' ? 'bg-warning' : 
            ($p->status == 'disetujui' ? 'bg-success' : 
            ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $p->status }}
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $cpanel->links() }}
  </div>
@endsection