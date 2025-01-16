@extends('dashboard.layouts.main')

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

<style>
    /* Sembunyikan seluruh file tools */
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none !important;
    }

    /* Atau lebih spesifik */
    trix-toolbar .trix-button--icon-attach {
        display: none !important;
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
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" 
        id="title" name="title">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori Berita</label>
            <select class="form-select" name="category_id">
                <option selected disabled>Silahkan Pilih Kategori Berita</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>  
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label @error('image') is-invalid @enderror">Foto Berita</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Tulisan Anda</label>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body"></trix-editor>
            @error('body')
            <p class="text-danger">
                {{ $message }}
            </p>
            @enderror
        </div>  
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

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