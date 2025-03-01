@extends('dashboard.layouts.main')

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    /* Sembunyikan seluruh file tools */
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none !important;
    }

    /* Atau lebih spesifik */
    trix-toolbar .trix-button--icon-attach {
        display: none !important;
    }   
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
    <h2>Tambah Berita</h2>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/post/admin/store" class="mb-5" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
        <label for="title" class="form-label @error('title') is-invalid @enderror">Judul</label>
        <div class="d-flex align-items-center">
        <input type="text" class="form-control " 
        id="title" name="title">
        <span class="valid-icon" id="valid-title" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori Berita</label>
            <div class="d-flex align-items-center">
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option selected disabled>Silahkan Pilih Kategori Berita</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>  
                @endforeach
            </select>
            <span class="valid-icon" id="valid-category_id" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('category_id')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label @error('image') is-invalid @enderror">Foto Berita</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Tulisan Anda</label>
                <input id="body" type="hidden" name="body" @error('body') is-invalid @enderror>{{ old('body') }}
                <trix-editor input="body"></trix-editor>
                <div class="d-flex align-items-center">
                <span class="valid-icon" id="valid-body" style="display: none;"><i class="fas fa-check" style="color: green;"></i></span>
            </div>
            @error('body')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Validasi Judul
    $('#title').on('input', function() {
        const validIcon = $('#valid-title');
        const value = $(this).val();
        
        if (value.length > 0 && value.length <= 255) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });

    // Validasi Kategori Berita
    $('#category_id').on('change', function() {
        const validIcon = $('#valid-category_id');
        const value = $(this).val();
        
        if (value && value !== 'Silahkan Pilih Kategori Berita') {
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
        if (value.length > 0 && value.length <= 1000 ) {
            validIcon.show();
            $(this).removeClass('is-invalid');
        } else {
            validIcon.hide();
            $(this).addClass('is-invalid');
        }
    });
});
    </script>
<script>
    function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFEvent){
        // Perbaiki penulisan variabel
        imgPreview.src = oFEvent.target.result;
    }
}
</script>
  
@endsection