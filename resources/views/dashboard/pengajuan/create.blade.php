@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Tanda Tangan Elektronik</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengajuan/store" class="mb-5">
        @csrf
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama
        <small class="form-text text-muted d-block">
            (Maksimal 20 Karakter termasuk spasi, tanpa tanda baca, misal ANDI SETIAWAN ST MM)
        </small>
        </label>
        <input type="text" class="form-control" 
        id="nama" name="nama">
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nip" name="nip">
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label @error('nik') is-invalid @enderror">NIK KTP
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 33741103098720001)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nik" name="nik">
            @error('nik')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_opd" class="form-label @error('nama_opd') 
            is-invalid @enderror">Nama OPD</label>
            <input type="text" class="form-control" 
            id="nama_opd" name="nama_opd">
            @error('nama_opd')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon
                <small class="form-text text-muted d-block">
                    (Contoh : 0818824864)
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
            <label for="email_domain" class="form-label @error('email_domain') is-invalid @enderror">
                Email Domain
                <small class="form-text text-muted d-block">
                    (Pastikan email valid dan bisa dibuka, hanya menerima email @semarangkota.go.id)
                </small>  
            </label>
            <input type="email" class="form-control" 
            id="email_domain" name="email_domain">
            @error('email_domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">
                Jabatan 
            </label>
            <input type="text" class="form-control" 
            id="jabatan" name="jabatan">
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection