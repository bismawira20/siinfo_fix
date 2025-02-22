@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Pengajuan</h1>
</div>

<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">Nama</th>
                        <td>{{ $pengajuan->nama }}</td>
                    </tr>
                    <tr>
                        <th width="30%">NIP</th>
                        <td>{{ $pengajuan->nip }}</td>
                    </tr>
                    <tr>
                        <th width="30%">NIK</th>
                        <td>{{ $pengajuan->nik }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama OPD</th>
                        <td>{{ $pengajuan->nama_opd }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No Telepon</th>
                        <td>{{ $pengajuan->no_telp }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Email Domain</th>
                        <td>{{ $pengajuan->email_domain }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Jabatan</th>
                        <td>{{ $pengajuan->jabatan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggapan</th>
                        <td>{{ $pengajuan->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($pengajuan->status == 'diproses') bg-warning
                                @elseif($pengajuan->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('pengajuan.admin.update', $pengajuan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan') }}</textarea>
                    @error('tanggapan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    Kirim Tanggapan
                </button>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection