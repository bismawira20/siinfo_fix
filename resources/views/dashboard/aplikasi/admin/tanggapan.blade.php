@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Pembuatan Aplikasi</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">NIP</th>
                        <td>{{ $aplikasi->nip}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama PIC</th>
                        <td>{{ $aplikasi->nama_pic}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Jabatan</th>
                        <td>{{ $aplikasi->jabatan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">OPD</th>
                        <td>{{ $aplikasi->opd }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Email</th>
                        <td>{{ $aplikasi->email }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No WA</th>
                        <td>{{ $aplikasi->no_telp}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama Aplikasi</th>
                        <td>{{ $aplikasi->nama_app }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Deskripsi</th>
                        <td>{{ $aplikasi->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tipe Aplikasi</th>
                        <td>{{ $aplikasi->tipe }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Tahun Pembuatan</th>
                        <td>{{ $aplikasi->tahun_pembuatan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Bahasa Pemograman</th>
                        <td>{{ $aplikasi->bahasa_pemograman }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Framework</th>
                        <td>{{ $aplikasi->framework }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Database</th>
                        <td>{{ $aplikasi->database }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Sistem Operasi</th>
                        <td>{{ $aplikasi->sistem_operasi }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Instalasi</th>
                        <td>{{ $aplikasi->instalasi }}</td>
                    </tr>
                    <tr>
                        <th>Dokumen Terlampir</th>
                        <td>
                            @if($aplikasi->dokumen)
                                @php
                                    $fileExtension = pathinfo($aplikasi->dokumen, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $aplikasi->dokumen);
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
                        <td>{{ $aplikasi->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($aplikasi->status == 'diproses') bg-warning 
                                @else bg-success 
                                @endif">
                                {{ ucfirst($aplikasi->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('aplikasi.admin.update', $aplikasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $aplikasi->tanggapan) }}</textarea>
                    
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