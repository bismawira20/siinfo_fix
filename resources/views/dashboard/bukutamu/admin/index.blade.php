@extends('dashboard.layouts.main')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      flatpickr('.flatpickr', {
          dateFormat: "Y-m-d", // Format tanggal yang diinginkan
          // Anda dapat menambahkan opsi lain di sini
      });
  });
</script>


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Kunjungan</h1>
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
  <!-- Filter Tanggal -->
  <div class="col-lg-3 d-flex align-items-end">
    <input type="tanggal" name="tanggal" class="form-control flatpickr" value="{{ request('tanggal') }}" placeholder="Tanggal">
  </div>
  
  <!-- Filter Status -->
    <div class="col-lg-3 d-flex align-items-end">
        <!-- <label class="form-label">Status:</label> -->
        <select name="status" class="form-select" style="min-width: 10px;">
            <option value="" disabled selected hidden>Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <!-- Filter Bidang --> 
    <div class="col-lg-5 d-flex align-items-end">
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


<div class="table-responsive small col-lg-15">
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
      <button class="btn btn-success rounded mt-1">Setujui Semua</button>
    </form>

    <div class="d-inline">{{ $bukutamu->links() }}</div>
</div>
@endsection