@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Pembuatan Sub Domain dan VPS</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/domain/{{ $domain->id }}/update" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
        <div class="mb-3">
            <h6>Data Diri</h6>
        </div>
        <div class="mb-3">
        <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP</label>
        <input type="text" class="form-control" 
        id="nip" name="nip" value = {{ old('nip', $domain->nip) }}>
        @error('nip')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <input type="text" class="form-control" 
            id="nama_pic" name="nama_pic" value = {{ old('nama_pic', $domain->nama_pic) }}>
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
            <input type="text" class="form-control" 
            id="jabatan" name="jabatan" value = {{ old('jabatan', $domain->jabatan) }}>
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="opd" class="form-label @error('opd') is-invalid @enderror">OPD</label>
            <input type="text" class="form-control" 
            id="opd" name="opd" value = {{ old('opd', $domain->opd) }}>
            @error('opd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
            <input type="email" class="form-control" 
            id="email" name="email" value = {{ old('email', $domain->email) }}>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif! Contoh : 0818824864)
                </small> 
            </label>
            <input type="tel" class="form-control" 
            id="no_telp" name="no_telp" value = {{ old('no_telp', $domain->no_telp) }}>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Deskripsi Layanan</h6>
        </div>
        <div class="mb-3">
            <label for="paket" class="form-label">Paket Layanan</label>
            <select class="form-select @error('paket') is-invalid @enderror" name="paket">
                <option selected disabled>Silahkan Pilih Paket Layanan</option>
                <option value="Hanya Domain" {{ old('paket', isset($domain) ? $domain->paket : '') == 'Hanya Domain' ? 'selected' : '' }}>Hanya Domain</option>
                <option value="Domain & Hosting" {{ old('paket', isset($domain) ? $domain->paket : '') == 'Domain & Hosting' ? 'selected' : '' }}>Domain & Hosting</option>
                <option value="VPS (Virtual Private Server)" {{ old('paket', isset($domain) ? $domain->paket : '') == 'VPS (Virtual Private Server)' ? 'selected' : '' }}> VPS (Virtual Private Server)</option>
            </select>
            @error('paket')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_domain" class="form-label @error('nama_domain') is-invalid @enderror">Usulan Nama Domain</label>
            <input type="text" class="form-control" 
            id="nama_domain" name="nama_domain" value = {{ old('nama_domain', $domain->nama_domain) }}>
            @error('nama_domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fungsi_app" class="form-label">Fungsi Aplikasi</label>
            <textarea 
                class="form-control @error('fungsi_app') is-invalid @enderror" 
                name="fungsi_app" 
                id="fungsi_app" 
                rows="5" 
                placeholder="Masukkan fungsi aplikasi"
            >{{ old('fungsi_app', $domain->fungsi_app ?? '') }}</textarea>
            @error('fungsi_app')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="bahasa_pemograman" class="form-label">Bahasa Pemrograman</label>
            <input type="text" class="form-control @error('bahasa_pemograman') is-invalid @enderror" name="bahasa_pemograman" 
                   placeholder="Contoh: PHP, Java, Python" value = {{ old('bahasa_pemograman', $domain->bahasa_pemograman) }}>
            @error('bahasa_pemograman')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Data Dukung</h6>
        </div>

        <div class="mb-3">
            <label for="dokumen" class="form-label @error('dokumen') is-invalid @enderror">Data Dukung
                <small class="form-text text-muted d-block"> Surat permohonan yg ditandatangani kepala yang membidangi</small> 
            </label>
            <input class="form-control" type="file" id="dokumen" name="dokumen" value = {{ old('dokumen', $domain->dokumen) }}>
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection