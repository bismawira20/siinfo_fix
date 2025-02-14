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
                        <th width="30%">Nama OPD </th>
                        <td>{{ $emaildinas->nama_opd }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No PIC</th>
                        <td>{{ $emaildinas->nama_pic}}</td>
                    </tr>
                    <tr>
                        <th width="30%">NO Telp PIC</th>
                        <td>{{ $emaildinas->no_telp_pic}}</td>
                    </tr>
                    <tr>
                        <th>Surat Rekomendasi</th>
                        <td>
                            @if($emaildinas->file)
                                @php
                                    $fileExtension = pathinfo($emaildinas->file, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $emaildinas->file);
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
                        <th>Form Pengajuan</th>
                        <td>
                            @if($emaildinas->file)
                                @php
                                    $fileExtension = pathinfo($emaildinas->file, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $emaildinas->file);
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
                        <td>{{ $emaildinas->tanggapan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($emaildinas->status == 'diproses') bg-warning
                                @elseif($emaildinas->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($emaildinas->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
      </div>
  </div>
</div>
@endsection