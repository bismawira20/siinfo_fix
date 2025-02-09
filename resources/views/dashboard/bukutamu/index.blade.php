@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Kunjungan Anda</h1>
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
    <a href="/dashboard/bukutamu/create" class="btn btn-primary mb-3">Agendakan Kunjungan</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          {{-- <th scope="col">Nama</th>
          <th scope="col">No Telepon</th>
          <th scope="col">Instansi</th> --}}
          <th scope="col">Tujuan Bidang</th>
          <th scope="col">Tujuan Kunjungan</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Waktu</th>
          <th scope="col">Tanggapan Admin</th>
          {{-- <th scope="col">Aksi</th> --}}
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bukutamu as $b)
        <tr>
          <td>{{ $loop->iteration }}</td>
          {{-- <td>{{ $b->nama }}</td>
          <td>{{ $b->no_telp }}</td>
          <td>{{ $b->instansi }}</td> --}}
          <td>{{ $b->bidang->name }}</td>
          <td>{{ $b->tujuan }}</td>
          <td>{{ Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</td>
          <td>{{ $b->waktu }}</td>
          <td>{{ $b->tanggapan }}</td>
          {{-- <td>
            @if($b->created_at->diffInHours() < 1 && $b->status == 'pending')
              <a href="/dashboard/bukutamu/{{ $b->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
              <form action="/dashboard/bukutamu/{{ $b->id }}/destroy" method="post" class="d-inline">
                @csrf
                @method('delete')
                  <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                    <i class="bi bi-trash fs-6"></i></button>
              </form>
            @endif
          </td> --}}
          <td>              
            <span class="badge {{ 
            $b->status == 'diproses' ? 'bg-warning' : 
            ($b->status == 'disetujui' ? 'bg-success' : 
            ($b->status == 'ditolak' ? 'bg-danger' : 'bg-secondary')) 
            }}" style="font-size: 0.9em;">
            {{ $b->status }}
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $bukutamu->links() }}
  </div>
@endsection