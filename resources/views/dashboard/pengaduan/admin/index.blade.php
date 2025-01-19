@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard Pengaduan</h1>
</div>
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
          <th scope="col">Jenis Pengaduan</th>
          <th scope="col">Status</th>
          <th scope="col">Tanggapi</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengaduan as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp }}</td>
          <td>{{ $p->jenispengaduan->nama }}</td>
          <td>{{ $p->status }}</td>
          <td>
            <a href="{{ route('pengaduan.admin.tanggapi', $p->id) }}" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
          </td>
          <td>
            <form action="/dashboard/pengaduan/admin/{{ $p->id }}/setuju" method="POST" class="d-inline">
            @csrf
            @method('put')
            <button class="badge bg-success border-0">
                <i class="bi bi-check-lg fs-6"></i></button>
            </form>
            <form action="/dashboard/pengaduan/admin/{{ $p->id }}/tolak" method="POST" class="d-inline">
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
    <form action="/dashboard/pengaduan/admin/setujuSemua" method="POST" class="d-inline">
      @csrf
      @method('put')
      <button class="btn btn-success rounded">Setujui Semua</button>
    </form>
    
    <div class="d-inline">{{ $pengaduan->links() }}</div>
</div>
@endsection