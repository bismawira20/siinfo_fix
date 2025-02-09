@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Kunjungan</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">Nama Pengunjung</th>
                        <td>{{ $bukutamu->nama}}</td>
                    </tr>
                    <tr>
                        <th width="30%">No WhatsApp</th>
                        <td>{{ $bukutamu->no_telp}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Instansi</th>
                        <td>{{ $bukutamu->instansi }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tujuan Bidang</th>
                        <td>{{ $bukutamu->bidang->name }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tujuan Kunjungan</th>
                        <td>{{ $bukutamu->tujuan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggal Kunjungan</th>
                        <td>{{ $bukutamu->tanggal}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Waktu Kunjungan</th>
                        <td>{{ $bukutamu->waktu }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggapan Admin</th>
                        <td>{{ $bukutamu->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($bukutamu->status == 'diproses') bg-warning 
                                @elseif($bukutamu->status == 'disetujui') bg-success
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($bukutamu->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('bukutamu.admin.update', $bukutamu->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $bukutamu->tanggapan) }}</textarea>
                    
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
@endsection