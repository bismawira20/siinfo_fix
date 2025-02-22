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
    <h2>Ajukan Pengaduan</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/pengaduan/store" 
    enctype="multipart/form-data" class="mb-5">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="nama" name="nama">
                <span class="valid-icon" id="valid-nama" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('nama')
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
                <input type="tel" class="form-control" id="no_telp" name="no_telp">
                <span class="valid-icon" id="valid-no_telp" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pengaduan_id" class="form-label">Jenis Pengaduan</label>
            <div class="d-flex align-items-center">
                <select class="form-select" name="jenis_id" id="jenis_id" value="{{ old('jenis_id') }}"> <!-- Change from pengaduan_id to jenis_id -->
                    <option selected disabled>Silahkan Pilih Jenis Pengaduan</option>
                    @foreach ($jenispengaduan as $jp)
                    <option value="{{ $jp->id }}">{{ $jp->nama }}</option>  
                    @endforeach
                </select>
                <span class="valid-icon" id="valid-jenis_id" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label @error('file') is-invalid @enderror">Dokumen Pengaduan</label>
            <div class="d-flex align-items-center">
                <input class="form-control" type="file" id="file" name="file" value="{{ old('file') }}" accept=".pdf">
                <span class="valid-icon" id="valid-file" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @if(old('file') || isset($existingFileName))
                <small class="form-text text-muted">
                    @if(old('file'))
                        File yang diunggah sebelumnya: {{ old('file') }}
                    @else
                        File yang diunggah sebelumnya: {{ $existingFileName }}
                    @endif
                </small>
            @endif
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Pengaduan</label>
            <div class="d-flex align-items-center">
                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi') }}</textarea>
                <span class="valid-icon" id="valid-deskripsi" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('deskripsi')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Validasi Nama
    $('#nama').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-nama');
        const regex = /^[a-zA-Z\s]+$/;
        
        if (input.val().length > 0 && regex.test(input.val())) {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // Validasi Nomor Telepon
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

    // Validasi Jenis Pengaduan
    $('#jenis_id').on('change', function() {
        const input = $(this);
        const validIcon = $('#valid-jenis_id');
        
        if (input.val() && input.val() !== 'Silahkan Pilih Jenis Pengaduan') {
            validIcon.show();
            input.removeClass('is-invalid');
        } else {
            validIcon.hide();
            input.addClass('is-invalid');
        }
    });

    // Validasi File
    $('#file').on('change', function() {
        const input = $(this);
        const validIcon = $('#valid-file');
        const allowedExtensions = ['pdf'];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        const file = this.files[0];
        if (file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (allowedExtensions.includes(fileExtension) && file.size <= maxSize) {
                validIcon.show();
                input.removeClass('is-invalid');
            } else {
                validIcon.hide();
                input.addClass('is-invalid');
            }
        }
    });

    // Validasi Deskripsi
    $('#deskripsi').on('input', function() {
        const input = $(this);
        const validIcon = $('#valid-deskripsi');
        
        if (input.val().length > 10) { // Minimal 10 karakter
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