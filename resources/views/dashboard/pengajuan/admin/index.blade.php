@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Pengajuan TTE</h1>
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
        <select name="status" class="form-select" style="min-width: 200px;">
            <option value="" disabled selected hidden>Status</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<div class="table-responsive small col-lg-15">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">NIK</th>
            <th scope="col">No Telp</th>
            <th scope="col">Nama OPD</th>
            <th scope="col">Email Domain</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengajuan as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->nip }}</td>
          <td>{{ $p->nik }}</td>
          <td>{{ $p->no_telp }}</td>
          <td>{{ $p->nama_opd }}</td>
          <td>{{ $p->email_domain }}</td>
          <td>{{ $p->jabatan }}</td>
          <td>              
            <span class="badge {{ 
            $p->status == 'diproses' ? 'bg-warning' : 
            ($p->status == 'selesai' ? 'bg-success' : 
            ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $p->status }}
            </span>
          </td>
          <td>
            <form action="/dashboard/pengajuan/admin/{{ $p->id }}/selesai" method="POST" class="d-inline">
            @csrf
            @method('put')
            <button class="badge bg-success border-0">
                <i class="bi bi-check-lg fs-6"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <form action="/dashboard/pengajuan/admin/selesaiSemua" method="POST" class="d-inline">
      @csrf
      @method('put')
      <button class="btn btn-success rounded">Selesaikan Semua</button>
    </form>
    
    <div class="d-inline">{{ $pengajuan->links() }}</div>
</div>
@endsection