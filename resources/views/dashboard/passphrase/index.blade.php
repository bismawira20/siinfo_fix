@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Pengajuan Reset Password Email Dinas/Passphrase TTE</h1>
</div>

<div class="">
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
</div>

<div class="table-responsive small col-lg-15">
  <a href="/dashboard/passphrase/create" class="btn btn-primary mb-3">Ajukan Passphrase</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pemohon</th>
            <th scope="col">No HP Pemohon</th>
            <th scope="col">Nama User</th>
            <th scope="col">Email User</th>
            <th scope="col">Alasan</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($passphrase as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->no_telp }}</td>
          <td>{{ $p->nama_user }}</td>
          <td>{{ $p->email_domain }}</td>
          <td>{{ $p->alasan }}</td>
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
            @if($p->created_at->diffInHours() < 1 && $p->status == 'diproses')
              <a href="{{ route('passphrase.edit', $p->id) }}" class="badge bg-warning"><i class="bi bi-pencil-square fs-6"></i></a>
              <form action="{{ route('passphrase.destroy', $p->id) }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                  <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin?')">
                    <i class="bi bi-trash fs-6"></i></button>
              </form>
            @endif
            {{-- <form action="/dashboard/bukutamu/admin/{{ $b->id }}/tolak" method="POST" class="d-inline">
              @csrf
              @method('put')
                <button class="badge bg-danger border-0 mt-1">
                    <i class="bi bi-x-lg fs-6"></i></button>
            </form> --}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
<div class="d-flex justify-content-between align-items-center">
    <div class="d-inline">{{ $passphrase->links() }}</div>
</div>
@endsection