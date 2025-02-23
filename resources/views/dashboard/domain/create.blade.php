@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .is-invalid {
        border-color: red;
    }
    .valid-icon {
        display: none;
        color: green;
        margin-left: 5px;
    }
</style>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Permohonan Subdomain & VPS</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/domain/store" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <h6>Data Diri</h6>
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}">
                <span class="valid-icon" id="valid-nip" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nip')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}">
                <span class="valid-icon" id="valid-nama_pic" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                <span class="valid-icon" id="valid-jabatan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="opd" class="form-label @error('opd') is-invalid @enderror">OPD</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="opd" name="opd" value="{{ old('opd') }}">
                <span class="valid-icon" id="valid-opd" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('opd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email
                <small class="form-text text-muted d-block"> Masukkan Email Aktif! Contoh: nama@semarangkota.go.id</small>
            </label>
            <div class="d-flex align-items-center">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <span class="valid-icon" id="valid-email" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
                Masukkan Whatsapp Aktif!
                </small> 
            </label>
            <div class="d-flex align-items-center">
                <input type="tel" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                <span class="valid-icon" id="valid-no_telp" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
            <div class="d-flex align-items-center">
                <select class="form-select @error('paket') is-invalid @enderror" id="paket" name="paket">
                    <option selected disabled>Silahkan Pilih Paket Layanan</option>
                    <option value="Hanya Domain" {{ old('paket') == 'Hanya Domain' ? 'selected' : '' }}>Hanya Domain</option>
                    <option value="Domain & Hosting" {{ old('paket') == 'Domain & Hosting' ? 'selected' : '' }}>Domain & Hosting</option>
                    <option value="VPS (Virtual Private Server)" {{ old('paket') == 'VPS (Virtual Private Server)' ? 'selected' : '' }}>VPS (Virtual Private Server)</option>
                </select>
                <span class="valid-icon" id="valid-paket" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('paket')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_domain" class="form-label @error('nama_domain') is-invalid @enderror">
                Usulan Nama Domain
                <small class="form-text text-muted d-block">
                    nama.semarangkota.go.id
                </small> 
            </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nama_domain" name="nama_domain" value="{{ old('nama_domain') }}">
                <span class="valid-icon" id="valid-nama_domain" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama_domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fungsi_app" class="form-label">Fungsi Aplikasi</label>
            <div class="d-flex align-items-center">
                <textarea class="form-control @error('fungsi_app') is-invalid @enderror" 
                          name="fungsi_app" 
                          id="fungsi_app" 
                          rows="5" 
                          placeholder="Masukkan fungsi aplikasi">{{ old('fungsi_app') }}</textarea>
                <span class="valid-icon" id="valid-fungsi_app" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('fungsi_app')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bahasa_pemograman" class="form-label">Bahasa Pemrograman</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control @error('bahasa_pemograman') is-invalid @enderror" 
                       id="bahasa_pemograman"
                       name="bahasa_pemograman"
                       value="{{ old('bahasa_pemograman') }}" 
                       placeholder="Contoh: PHP, Java, Python">
                <span class="valid-icon" id="valid-bahasa_pemograman" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
            <label for="dokumen" class="form-label @error('dokumen') is-invalid @enderror">
                Data Dukung
                <small class="form-text text-muted d-block">Surat permohonan yang ditandatangani oleh kepala bidang terkait</small> 
            </label>
            <div class="d-flex align-items-center">
                <input class="form-control" type="file" id="dokumen" name="dokumen" value="{{ old('dokumen') }}" accept=".pdf">
                <span class="valid-icon" id="valid-dokumen" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Validasi NIP
    $('#nip').on('input', function() {
        const validIcon = $('#valid-nip');
        const value = $(this).val();
        
        if (/^\d{18}$/.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Nama PIC
    $('#nama_pic').on('input', function() {
        const validIcon = $('#valid-nama_pic');
        const regex = /^[\p{L} ]+$/u;
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255 && regex.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Jabatan
    $('#jabatan').on('input', function() {
        const validIcon = $('#valid-jabatan');
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi OPD
    $('#opd').on('input', function() {
        const validIcon = $('#valid-opd');
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Email
    $('#email').on('input', function() {
        const validIcon = $('#valid-email');
        const regex = /^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/;
        const value = $(this).val();
        
        if (regex.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Nomor Telepon
    $('#no_telp').on('input', function() {
        const validIcon = $('#valid-no_telp');
        const value = $(this).val();
        
        if (/^\d{10,15}$/.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Paket
    $('#paket').on('change', function() {
        const validIcon = $('#valid-paket');
        const value = $(this).val();
        
        if (value && value !== 'Silahkan Pilih Paket Layanan') {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Nama Domain
    $('#nama_domain').on('input', function() {
        const validIcon = $('#valid-nama_domain');
        const regex = /^[a-zA-Z0-9._%+-]+\.semarangkota\.go\.id$/;
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255 && regex.test(value)) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Fungsi Aplikasi
    $('#fungsi_app').on('input', function() {
        const validIcon = $('#valid-fungsi_app');
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 1000) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Bahasa Pemrograman
    $('#bahasa_pemograman').on('input', function() {
        const validIcon = $('#valid-bahasa_pemograman');
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Dokumen
    $('#dokumen').on('change', function() {
        const validIcon = $('#valid-dokumen');
        const file = this.files[0];
        
        if (file && file.type === 'application/pdf' && file.size <= 1024 * 1024) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });
});
</script>

@endsection