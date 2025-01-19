@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Tambah Pengaduan Anda</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengaduan/store" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
        <input type="text" class="form-control" 
        id="nama" name="nama">
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
            id="no_telp" name="no_telp">
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pengaduan_id" class="form-label">Jenis Pengaduan</label>
            <select class="form-select" name="jenis_id"> <!-- Change from pengaduan_id to jenis_id -->
                <option selected disabled>Silahkan Pilih Jenis Pengaduan</option>
                @foreach ($jenispengaduan as $jp)
                <option value="{{ $jp->id }}">{{ $jp->nama }}</option>  
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label @error('file') is-invalid @enderror">Dokumen Pengaduan</label>
            <input class="form-control" type="file" id="file" name="file">
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Pengaduan</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi') }}</textarea>
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