@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Layanan Pengaduan</h1>
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
    <a href="/dashboard/pengaduan/create" class="btn btn-primary mb-3">Ajukan Pengaduan</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          {{-- <th scope="col">Nama</th>
          <th scope="col">No Telp</th> --}}
          <th scope="col">Jenis Pengaduan</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Tanggapan</th>          
          <!-- <th scope="col">Aksi</th> -->
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengaduan as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->jenispengaduan->nama }}</td>
          <td>{{ $p->deskripsi }}</td>
          <td>{{ $p->tanggapan }}</td>
          <!-- <td>
            @if($p->created_at->diffInHours() < 1 && $p->status == 'pending')
            <a href="/dashboard/pengaduan/{{ $p->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
            <form action="/dashboard/pengaduan/{{ $p->id }}/destroy" method="post" class="d-inline">
              @csrf
              @method('delete')
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                  <i class="bi bi-trash fs-6"></i></button>
            </form>
            @endif
          </td> -->
          <td>
            <span class="badge {{ 
            $p->status == 'pending' ? 'bg-warning' : 
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
    {{ $pengaduan->links() }}
  </div>
@endsection