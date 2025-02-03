@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Kunjungan</h1>
</div>
<form method="GET" action="{{ url()->current() }}" class="mb-3 d-flex gap-2 align-items-end">
  <!-- Filter Waktu -->
  <div class="text-center">
        <label class="form-label">Tanggal Awal:</label>
        <input type="date" name="start_date" class="form-control" style="width: 200px;" value="{{ request('start_date', '2024-01-01') }}">
    </div>
    <div class="text-center">
        <label class="form-label">Tanggal Akhir:</label>
        <input type="date" name="end_date" class="form-control" style="width: 200px;" value="{{ request('end_date', '2024-12-31') }}">
    </div>

    <!-- Filter Status -->
    <div style="flex-grow: 1;">
        <!-- <label class="form-label">Status:</label> -->
        <select name="status" class="form-select" style="min-width: 10px;">
            <option value="" disabled selected hidden>Status</option>
            <option value="diproses" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="selesai" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="selesai" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <!-- Filter Bidang --> 
    <div style="flex-grow: 1;">
        <!-- <label class="form-label">Bidang:</label> -->
        <select name="bidang" class="form-select" style="min-width: 10px;">
            <option value="" disabled selected hidden>Bidang</option>
            @foreach ($bidang as $b)
                <option value="{{ $b->id }}" {{ request('bidang') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Filter</button>
</form>

{{-- <div class="input-group mb-3 col-lg-30">
  <input type="text" class="form-control" placeholder="Cari" name ="search">
  <button class="btn btn-primary" type="submit" style="margin-left: 5px;">Cari</button>
</div> --}}
<div class="table-responsive small col-lg-15">
  @if(session()->has('success'))
  </div>
    <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
    {{-- <a href="/dashboard/bukutamu/create" class="btn btn-primary mb-3">Agendakan Kunjungan</a> --}}
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">No Telepon</th>
          <th scope="col">Instansi</th>
          <th scope="col">Tujuan Bidang</th>
          <th scope="col">Tujuan Kunjungan</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bukutamu as $b)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $b->nama }}</td>
          <td>{{ $b->no_telp }}</td>
          <td>{{ $b->instansi }}</td>
          <td>{{ $b->bidang->name }}</td>
          <td>{{ $b->tujuan }}</td>
          <td>{{ Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</td>
          <td>
            <span class="badge {{ 
            $b->status == 'pending' ? 'bg-warning' : 
            ($b->status == 'disetujui' ? 'bg-success' : 
            ($b->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $b->status }}
            </span>
          </td>
          <td>
            <form action="/dashboard/bukutamu/admin/{{ $b->id }}/setuju" method="POST" class="d-inline">
            @csrf
            @method('put')
            <button class="badge bg-success border-0">
                <i class="bi bi-check-lg fs-6"></i></button>
            </form>
            <form action="/dashboard/bukutamu/admin/{{ $b->id }}/tolak" method="POST" class="d-inline">
              @csrf
              @method('put')
                <button class="badge bg-danger border-0 mt-1">
                    <i class="bi bi-x-lg fs-6"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <form action="/dashboard/bukutamu/admin/setujuSemua" method="POST" class="d-inline">
      @csrf
      @method('put')
      <button class="btn btn-success rounded">Setujui Semua</button>
    </form>
    
    <div class="d-inline">{{ $bukutamu->links() }}</div>
</div>
@endsection