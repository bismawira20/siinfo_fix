@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Pengaduan</h1>
</div>
<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">Nama Pengadu</th>
                        <td>{{ $pengaduan->nama }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nomor Telepon</th>
                        <td>{{ $pengaduan->no_telp }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Jenis Pengaduan</th>
                        <td>{{ $pengaduan->jenispengaduan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($pengaduan->status == 'pending') bg-warning 
                                @elseif($pengaduan->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($pengaduan->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Deskripsi</th>
                        <td>{{ $pengaduan->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Dokumen Terlampir</th>
                        <td>
                            @if($pengaduan->file)
                                @php
                                    $fileExtension = pathinfo($pengaduan->file, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $pengaduan->file);
                                @endphp

                                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ $filePath }}" target="_blank">
                                        <img src="{{ $filePath }}" 
                                             alt="Dokumen Pengaduan" 
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
                    <!-- <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $pengaduan->created_at->format('d M Y H:i') }}</td>
                    </tr> -->
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('pengaduan.admin.update', $pengaduan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                    
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