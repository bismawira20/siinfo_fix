@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Layanan Sub Domain & VPS</h1>
</div>

<div class="container">
  <div class="row my-3">
      <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th width="30%">NIP</th>
                        <td>{{ $domain->nip }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama PIC</th>
                        <td>{{ $domain->nama_pic }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Jabatan</th>
                        <td>{{ $domain->jabatan }}</td>
                    </tr>
                    <tr>
                        <th width="30%">OPD</th>
                        <td>{{ $domain->opd }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Email</th>
                        <td>{{ $domain->email }}</td>
                    </tr>
                    <tr>
                        <th width="30%">No Telepon</th>
                        <td>{{ $domain->no_telp }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Paket</th>
                        <td>{{ $domain->paket }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Nama Domain</th>
                        <td>{{ $domain->nama_domain }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Fungsi Aplikasi</th>
                        <td>{{ $domain->fungsi_app }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Bahasa Pemrograman</th>
                        <td>{{ $domain->bahasa_pemrograman }}</td>
                    </tr>
                    <tr>
                        <th>Dokumen Terlampir</th>
                        <td>
                            @if($domain->dokumen)
                                @php
                                    $fileExtension = pathinfo($domain->dokumen, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $domain->dokumen);
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
                    <!-- <tr>
                        <th width="30%">Tanggapan Admin</th>
                        <td>{{ $domain->tanggapan }}</td>
                    </tr> -->
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($domain->status == 'diproses') bg-warning
                                @elseif($domain->status == 'disetujui') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($domain->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <div class="mt-3">
            <h4>Tanggapan Admin</h4>

            <form action="{{ route('domain.admin.update', $domain->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <textarea 
                        class="form-control @error('tanggapan') is-invalid @enderror" 
                        id="tanggapan" 
                        name="tanggapan" 
                        rows="5" 
                        placeholder="Masukkan tanggapan Anda..."
                    >{{ old('tanggapan', $domain->tanggapan) }}</textarea>
                    
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