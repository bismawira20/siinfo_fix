@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        id="nama" name="nama" value="{{ old('nama') }}">
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
            id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
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
            id="instansi" name="instansi" value="{{ old('instasi') }}">
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
                <option value="{{ $bidang->id }}" {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                    {{ $bidang->name }}
                </option>  
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label @error('tujuan') is-invalid @enderror">Tujuan Kunjungan</label>
            <textarea class="form-control" id="tujuan" rows="3" name="tujuan">{{ old('tujuan') }}</textarea>
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
                value="{{ old('tanggal') }}"
            >
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
                    >
                    <label class="form-check-label" for="waktu-08:00">
                        08:00
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-10:00" 
                        value="10:00"
                    >
                    <label class="form-check-label" for="waktu-10:00">
                        10:00
                    </label>
                </div>
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="waktu" 
                        id="waktu-13:00" 
                        value="13:00"
                    >
                    <label class="form-check-label" for="waktu-13:00">
                        13:00
                    </label>
                </div>
            </div>
            @error('waktu')
            <div class="invalid-feedback d-block">
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
        disable: [
            function(date) {
                // Disable Saturday and Sunday
                return (date.getDay() === 6 || date.getDay() === 0);
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            // Cek tanggal yang dipilih
            $.ajax({
                url: "{{ route('bukutamu.check-tanggal') }}",
                method: 'GET',
                data: { tanggal: dateStr },
                success: function(response) {
                    if (response.count >= 3) {
                        alert('Tanggal sudah terdaftar 3 kali, silakan pilih tanggal lain.');
                        instance.clear();
                    } else {
                        // Tampilkan opsi waktu
                        showWaktuOptions(dateStr);
                    }
                }
            });
        }
    });

    function showWaktuOptions(tanggal) {
    $.ajax({
        url: "{{ route('bukutamu.get-waktu-options') }}",
        method: 'GET',
        data: { tanggal: tanggal },
        success: function(response) {
            // Log response untuk debugging
            console.log("Response dari server:", response);

            // Daftar semua waktu
            const semuaWaktu = ['08:00', '10:00', '13:00'];

            // Nonaktifkan semua radio button
            semuaWaktu.forEach(function(waktu) {
                $(`#waktu-${waktu}`)
                    .prop('disabled', true)
                    .parent().addClass('text-muted');
            });

            // Aktifkan hanya waktu yang tersedia
            response.waktu_tersedia.forEach(function(waktu) {
                $(`#waktu-${waktu}`)
                    .prop('disabled', false)
                    .parent().removeClass('text-muted');
            });
        },
        error: function(xhr, status, error) {
            console.error("Terjadi kesalahan:", error);
            console.log(xhr.responseText);
        }
    });
}
</script>
@endsection