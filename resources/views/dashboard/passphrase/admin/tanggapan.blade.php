@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Reset Password Email Dinas atau Passphrase TTE</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">Nama Pemohon </th>
                        <td>{{ $passphrase->nama }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No HP Pemohon</th>
                        <td>{{ $passphrase->no_telp}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama User</th>
                        <td>{{ $passphrase->nama_user }}</td>
                    </tr>
                    <tr>
                        <th width="30%">NIK User</th>
                        <td>{{ $passphrase->nik_user }}</td>
                    </tr>
                    <tr>
                        <th width="30%">NIP User</th>
                        <td>{{ $passphrase->nip_user }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Email</th>
                        <td>{{ $passphrase->email_domain}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Alasan</th>
                        <td>{{ $passphrase->alasan}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggapan Admin</th>
                        <td>{{ $passphrase->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($passphrase->status == 'diproses') bg-warning
                                @elseif($passphrase->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($passphrase->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('passphrase.admin.update', $passphrase->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $passphrase->tanggapan) }}</textarea>
                    
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