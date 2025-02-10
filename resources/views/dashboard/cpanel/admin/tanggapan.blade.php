@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Reset CPANEL</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">Nama</th>
                        <td>{{ $cpanel->nama}}</td>
                    </tr>
                    <tr>
                        <th width="30%">No Telepon</th>
                        <td>{{ $cpanel->no_telp}}</td>
                    </tr>
                    <tr>
                        <th width="30%">NIP</th>
                        <td>{{ $cpanel->nip }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Jabatan</th>
                        <td>{{ $cpanel->jabatan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">OPD</th>
                        <td>{{ $cpanel->asal_opd }}</td>
                    </tr>
                    <tr>
                        <th width="30%">URL</th>
                        <td>{{ $cpanel->url}}</td>
                    </tr>
                    <tr>
                        <th>Dokumen Terlampir</th>
                        <td>
                            @if($cpanel->file)
                                @php
                                    $fileExtension = pathinfo($cpanel->file, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $cpanel->file);
                                @endphp

                                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ $filePath }}" target="_blank">
                                        <img src="{{ $filePath }}" 
                                             alt="Dokumen Aplikasi" 
                                             class="img-fluid" 
                                             style="max-height: 200px;">
                                    </a>
                                @else
                                    <a href="{{ $filePath }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary">
                                        <i class="bi bi-file-earmark-{{ $fileExtension }}"></i> 
                                        Lihat Dokumen ({{ strtoupper($fileExtension) }})
                                    </a>
                                @endif
                            @else
                                Tidak ada dokumen terlampir
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Tanggapan Admin</th>
                        <td>{{ $cpanel->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($cpanel->status == 'diproses') bg-warning
                                @elseif($cpanel->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($cpanel->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('cpanel.admin.update', $cpanel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $cpanel->tanggapan) }}</textarea>
                    
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