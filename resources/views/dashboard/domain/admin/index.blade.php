@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Permintaan Sub Domain dan VPS</h1>
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
    <div class="col-lg-3 d-flex align-items-end">
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
          <th scope="col">Nama Domain</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($domain as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama_pic }}</td>
          <td>{{ $p->no_telp}}</td>
          <td>{{ $p->opd }}</td>
          <td>{{ $p->nama_domain}}</td>
          <td>              
            <span class="badge {{ 
            $p->status == 'diproses' ? 'bg-warning' : 
            ($p->status == 'disetujui' ? 'bg-success' : 
            ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $p->status }}
            </span>
          </td>
          <td>
              <div class="d-flex align-items-center gap-1">
                  <a href="{{ route('domain.admin.tanggapan', $p->id) }}" 
                      class="badge bg-warning d-flex align-items-center justify-content-center text-decoration-none">
                      <i class="bi bi-pencil-square fs-6 m-0"></i>
                  </a>
                  
                  <a href="{{ route('domain.admin.show', $p->id) }}" 
                      class="badge bg-primary d-flex align-items-center justify-content-center text-decoration-none">
                      <i class="bi bi-eye fs-6"></i>
                  </a>
                  
                  <form action="/dashboard/domain/admin/{{ $p->id }}/selesai" method="POST" class="d-inline">
                      @csrf
                      @method('put')
                      <button class="badge bg-success border-0 d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-lg fs-6"></i>
                      </button>
                  </form>
                  
                  <form action="/dashboard/domain/admin/{{ $p->id }}/tolak" method="POST" class="d-inline">
                      @csrf
                      @method('put')
                      <button class="badge bg-danger border-0 d-flex align-items-center justify-content-center">
                          <i class="bi bi-x-lg fs-6 m-0"></i>
                      </button>
                  </form>
              </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <form action="/dashboard/domain/admin/selesaiSemua" method="POST" class="d-inline">
        @csrf
        @method('put')
        <button class="btn btn-success rounded">Selesaikan Semua</button>
    </form>

    <div>{{ $domain->links() }}</div>
  </div>
@endsection