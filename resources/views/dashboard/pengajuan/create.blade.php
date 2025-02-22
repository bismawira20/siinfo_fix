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
    <h2>Ajukan Permohonan Tanda Tangan Elektronik</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengajuan/store" class="mb-5">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama
                <small class="form-text text-muted d-block"> (Maksimal 20 Karakter termasuk spasi, tanpa tanda baca, misal ANDI SETIAWAN ST MM)
                </small>
            </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nama" name="nama" value="{{ old('nama') }}">
                <span class="valid-icon" id="valid-nama" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP
            <!-- <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small> -->
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nip" name="nip">
                <span class="valid-icon" id="valid-nip" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nip')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nik" class="form-label @error('nik') is-invalid @enderror">NIK KTP
                <!-- <small class="form-text text-muted d-block">
                    Contoh: 3374110309872001
                </small> -->
            </label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nik" name="nik" value="{{ old('nik') }}">
                <span class="valid-icon" id="valid-nik" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nik')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_opd" class="form-label @error('nama_opd') is-invalid @enderror">Nama OPD</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="nama_opd" name="nama_opd" value="{{ old('nama_opd') }}">
                <span class="valid-icon" id="valid-nama_opd" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
                    Contoh : 0818824864
                </small> 
            </label>
            <div class="d-flex align-items-center">
                <input type="tel" class="form-control" 
                id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                <span class="valid-icon" id="valid-no_telp" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
                    Pastikan email valid dan bisa dibuka, hanya menerima email @semarangkota.go.id
                </small>  
            </label>
            <div class="d-flex align-items-center">
                <input type="email" class="form-control" 
                id="email_domain" name="email_domain" value="{{ old('email_domain') }}">
                <span class="valid-icon" id="valid-email_domain" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
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
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" 
                id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                <span class="valid-icon" id="valid-jabatan" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('jabatan')
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
    // validasi nama -> masih perlu dibenerin sih regexnya
    $('#nama').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nama');
        const regex = /^[a-zA-Z\s]+$/;

        if (input.val().length > 20 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi nip
    $('#nip').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nip');
        const regex = /^\d{18}$/; // Format NIP 18 digit

        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi nik
    $('#nik').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nip');
        const regex = /^\d{16}$/; // Format NIP 18 digit

        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi nama opd
    $('#nama_opd').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nama_opd');
        const regex = /^[a-zA-Z\s]+$/;

        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi no telp
    $('#no_telp').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-no_telp');
        const regex = /^08\d{10,15}$/; // Format nomor Indonesia
        
        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi email domain
    $('#email_domain').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-email');
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //format nama email tidak boleh selain nama@semarangkota.go.id
        
        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // validasi jabatan
    $('#jabatan').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-jabatan');
        const regex = /^[a-zA-Z\s]+$/;

        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });
});
</script>

@endsection