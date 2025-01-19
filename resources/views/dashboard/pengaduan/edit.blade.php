@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Tambah Pengaduan Anda</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengaduan/{{ $pengaduan->id }}/update" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
        <input type="text" class="form-control" 
        id="nama" name="nama" value="{{ old('nama', $pengaduan->nama) }}">
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon 
                <small class="form-text text-muted d-block">
                    Harap menggunakan Nomor WhatsApp Anda!
                </small>
            </label>
            <input type="tel" class="form-control" 
            id="no_telp" name="no_telp" value="{{ old('no_telp', $pengaduan->no_telp) }}">
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_id" class="form-label">Jenis Pengaduan</label>
            <select class="form-select @error('jenis_id') is-invalid @enderror" name="jenis_id">
                <option value="" selected disabled>Silahkan Pilih Jenis Pengaduan</option>
                @foreach ($jenispengaduan as $jp)
                    <option value="{{ $jp->id }}" 
                        {{ (old('jenis_id', $pengaduan->jenis_id) == $jp->id) ? 'selected' : '' }}>
                        {{ $jp->nama }} {{-- Pastikan menggunakan nama kolom yang benar --}}
                    </option>  
                @endforeach
            </select>
            @error('jenis_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Dokumen Pengaduan</label>
            
            @if($pengaduan->file)
                <div class="mb-2">
                    @php
                        $fileExtension = pathinfo($pengaduan->file, PATHINFO_EXTENSION);
                    @endphp
        
                    @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ asset('storage/' . $pengaduan->file) }}" 
                             alt="Dokumen" 
                             class="img-thumbnail" 
                             style="max-width: 300px;">
                    @else
                        <a href="{{ asset('storage/' . $pengaduan->file) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary">
                            <i class="bi bi-file-earmark-pdf"></i> Lihat Dokumen
                        </a>
                    @endif
                </div>
            @endif
        
            <input class="form-control @error('file') is-invalid @enderror" 
                   type="file" 
                   id="file" 
                   name="file"
                   accept=".pdf,.jpg,.jpeg,.png">
            
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Pengaduan</label>
            <textarea id="deskripsi" name="deskripsi" 
            class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi',$pengaduan->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection