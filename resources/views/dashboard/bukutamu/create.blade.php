@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2> Agendakan Kunjungan Anda</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/bukutamu/store" class="mb-5">
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
            <label for="instansi" class="form-label @error('instansi') is-invalid @enderror">
                Instansi 
            </label>
            <input type="text" class="form-control" 
            id="instansi" name="instansi">
            @error('instansi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="bidang_id" class="form-label">Tujuan Bidang</label>
            <select class="form-select" name="bidang_id">
                <option selected disabled>Silahkan Pilih Bidang Tujuan</option>
                @foreach ($bidangs as $bidang)
                <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>  
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label @error('tujuan') is-invalid @enderror">Tujuan Kunjungan</label>
            <textarea class="form-control" id="tujuan" rows="3" name="tujuan"></textarea>
            @error('tujuan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label @error('tanggal') is-invalid @enderror">Tanggal Kunjungan</label>
            <input 
                type="text" 
                class="form-control" 
                id="tanggal" 
                name="tanggal"
            >
            @error('tanggal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    flatpickr("#tanggal", {
        dateFormat: "Y-m-d",
        minDate: "today",
        // Tambahan opsi
        // disableMobile: true // Nonaktifkan datepicker di mobile
    });
</script>
@endsection