@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Agenda Kunjungan Anda</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/bukutamu/{{ $bukutamu->id }}/update" class="mb-5">
        @csrf
        @method('put')
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
        <input type="text" class="form-control" 
        id="nama" name="nama" value = {{ old('nama', $bukutamu->nama) }}>
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
            <input type="tel" class="form-control" id="no_telp" name="no_telp" value = {{ old('nama', $bukutamu->no_telp) }}>
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
            id="instansi" name="instansi" value = {{ old('nama', $bukutamu->instansi) }}>
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
                @if(old('bidang_id', $bukutamu->bidang_id) == $bidang->id)
                    <option value="{{ $bidang->id }}" selected>{{ $bidang->name }}</option>                    
                @else
                    <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>  
                @endif  
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label @error('tujuan') is-invalid @enderror">Tujuan Kunjungan</label>
            <textarea class="form-control" id="tujuan" rows="3" name="tujuan" >{{ old('tujuan', $bukutamu->tujuan ?? '') }}</textarea>
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
                value="{{ old('tanggal', $bukutamu->tanggal) }}">
            @error('tanggal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Waktu Kunjungan</label>
            <div id="waktu-options">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-08:00" 
                        value="08:00" 
                        {{ old('waktu', $bukutamu->waktu) == '08:00' ? 'checked' : '' }}>
                    <label class="form-check-label" for="waktu-08:00">08:00</label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-10:00" 
                        value="10:00" 
                        {{ old('waktu', $bukutamu->waktu) == '10:00' ? 'checked' : '' }}>
                    <label class="form-check-label" for="waktu-10:00">10:00</label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-13:00" 
                        value="13:00" 
                        {{ old('waktu', $bukutamu->waktu) == '13:00' ? 'checked' : '' }}>
                    <label class="form-check-label" for="waktu-13:00">13:00</label>
                </div>
            </div>
            @error('waktu')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Agenda</button>
        </form>
        
        <script>
            // Inisialisasi Flatpickr untuk input tanggal
            flatpickr("#tanggal", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                function(date) {
                    // Disable Saturday and Sunday
                    return (date.getDay() === 6 || date.getDay() === 0);
                    }
                ],
                onChange: function(selectedDates, dateStr, instance) {
                    showWaktuOptions(dateStr); // Panggil fungsi untuk menampilkan waktu yang tersedia
                }
            });
        
            // Fungsi untuk menampilkan opsi waktu yang tersedia
            function showWaktuOptions(tanggal) {
                $.ajax({
                    url: "{{ route('bukutamu.get-waktu-options') }}",
                    method: 'GET',
                    data: { tanggal: tanggal },
                    success: function(response) {
                        // Sembunyikan semua radio button
                        $('#waktu-options .form-check-input').prop('disabled', true)
                            .parent().addClass('text-muted');
        
                        // Tampilkan hanya waktu yang tersedia
                        response.waktu_tersedia.forEach(function(waktu) {
                            $(`#waktu-${waktu}`)
                                .prop('disabled', false)
                                .parent().removeClass('text-muted');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                    }
                });
            }
        </script>
@endsection