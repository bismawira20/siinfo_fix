@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Permintaan Aplikasi</h1>
</div>

<div class="">
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
</div>


<form method="GET" action="{{ url()->current() }}" class="mb-3 d-flex gap-2 align-items-end">

    <!-- Filter Status -->
    <div style="col-lg-3 d-flex align-items-end">
        <!-- <label class="form-label">Status:</label> -->
        <select name="status" class="form-select" style="min-width: 200px;">
            <option value="" disabled selected hidden>Status</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>

    
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama PIC</th>
          <th scope="col">No Telp PIC</th>
          <th scope="col">Nama OPD</th>
          <th scope="col">Nama Aplikasi</th>
          <th scope="col">Aksi</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($aplikasi as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama_pic }}</td>
          <td>{{ $p->no_telp}}</td>
          <td>{{ $p->opd }}</td>
          <td>{{ $p->nama_app}}</td>
          <td>
            <a href="{{ route('aplikasi.admin.show', $p->id) }}" class="badge bg-primary mx-1"><i class="bi bi-eye fs-6"></i></a>
                <form action="/dashboard/aplikasi/admin/{{ $p->id }}/selesai" method="POST" class="d-inline">
                    @csrf
                    @method('put')
                    <button class="badge bg-success border-0">
                        <i class="bi bi-check-lg fs-6"></i></button>
                    </form>
          </td>
          <td>
            <span class="badge {{ 
              $p->status == 'diproses' ? 'bg-warning' : 
              ($p->status == 'selesai' ? 'bg-success' : 
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
  <div class="d-flex justify-content-between align-items-center">
    <form action="/dashboard/aplikasi/admin/selesaiSemua" method="POST" class="d-inline">
        @csrf
        @method('put')
        <button class="btn btn-success rounded">Selesaikan Semua</button>
    </form>

    <div>{{ $aplikasi->links() }}</div>
  </div>
@endsection