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
                                <th width="30%">Nama</th>
                                <td>{{ $pengaduan->nama }}</td>
                            </tr>
                            <tr>
                                <th width="30%">No Telepon</th>
                                <td>{{ $pengaduan->no_telp }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Deskripsi</th>
                                <td>{{ $pengaduan->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>File Pendukung</th>
                                <td>
                                    @if($pengaduan->file)
                                        @php
                                            $fileExtension = pathinfo($pengaduan->file, PATHINFO_EXTENSION);
                                            $filePath = asset('storage/' . $pengaduan->file);
                                        @endphp

                                        @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ $filePath }}" target="_blank">
                                                <img src="{{ $filePath }}" 
                                                     alt="File Pengaduan" 
                                                     class="img-fluid" 
                                                     style="max-height: 200px;">
                                            </a>
                                        @else
                                            <a href="{{ $filePath }}" 
                                               target="_blank" 
                                               class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-{{ $fileExtension }}"></i> 
                                                Lihat File ({{ strtoupper($fileExtension) }})
                                            </a>
                                        @endif
                                    @else
                                        Tidak ada file terlampir
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge 
                                        @if($pengaduan->status == 'diproses') bg-warning
                                        @elseif($pengaduan->status == 'selesai') bg-success 
                                        @else bg-danger 
                                        @endif">
                                        {{ ucfirst($pengaduan->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%">Tanggapan</th>
                                <td>{{ $pengaduan->tanggapan }}</td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
@endsection