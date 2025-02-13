@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Reset Email atau Passphrase TTE</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/passphrase/store" class="mb-5">
        @csrf

         <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap Pemohon</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                   id="nama" name="nama" value="{{ old('nama') }}" pattern="[a-zA-Z\s]+" 
                   title="Nama hanya boleh berisi huruf dan spasi">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nip_pemohon" class="form-label">NIP Pemohon</label>
            <small class="form-text text-muted d-block">(Tanpa spasi, tanpa tanda baca, 18 digit angka,  misal 198709032018021002)</small>
            <input type="text" class="form-control @error('nip_pemohon') is-invalid @enderror"
                   id="nip_pemohon" name="nip_pemohon" value="{{ old('nip_pemohon') }}" 
                   pattern="\d{18}" title="NIP harus terdiri dari 18 angka">
            @error('nip_pemohon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <small class="form-text text-muted d-block">(10-13 digit angka, sebaiknya terhubung WhatsApp, misal 0856789012345)</small>
            <input type="tel" class="form-control @error('no_telp') is-invalid @enderror"
                   id="no_telp" name="no_telp" value="{{ old('no_telp') }}" 
                   pattern="\d{10,13}" title="Nomor telepon harus terdiri dari 10-13 angka">
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_user" class="form-label">Nama User/Pemilik Akun</label>
            <input type="text" class="form-control @error('nama_user') is-invalid @enderror" 
                   id="nama_user" name="nama_user" value="{{ old('nama_user') }}" pattern="[a-zA-Z\s]+" 
                   title="Nama hanya boleh berisi huruf dan spasi">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nik_user" class="form-label">NIK User</label>
            <small class="form-text text-muted d-block">(16 digit angka,Tanpa spasi, tanpa tanda baca, misal 3374110309872001)</small>
            <input type="text" class="form-control @error('nik_user') is-invalid @enderror" 
                   id="nik_user" name="nik_user" value="{{ old('nik_user') }}" 
                   pattern="\d{16}" title="NIK harus terdiri dari 16 angka">
            @error('nik_user')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nip_user" class="form-label">NIP User</label>
            <small class="form-text text-muted d-block">(18 digit angka, Tanpa spasi, tanpa tanda baca, 18 digit angka,  misal 198709032018021002)</small>
            <input type="text" class="form-control @error('nip_user') is-invalid @enderror" 
                   id="nip_user" name="nip_user" value="{{ old('nip_user') }}" 
                   pattern="\d{18}" title="NIP harus terdiri dari 18 angka">
            @error('nip_user')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email_domain" class="form-label">Alamat Email User</label>
            <small class="form-text text-muted d-block">(Alamat email dengan domain @semarangkota.go.id, jika lupa/ belum memiliki 
            silakan berkoordinasi dengan petugas terkait)</small>
            <input type="email" class="form-control @error('email_domain') is-invalid @enderror" 
                   id="email_domain" name="email_domain" value="{{ old('email_domain') }}">
            @error('email_domain')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea class="form-control @error('alasan') is-invalid @enderror" 
                      id="alasan" name="alasan" rows="4" 
                      placeholder="Jelaskan alasan Anda">{{ old('alasan') }}</textarea>
            @error('alasan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Terms and Conditions Section -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    Saya telah membaca dan menyetujui 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat dan Ketentuan</a>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                @include('dashboard.layouts.terms_condition')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('termsCheckbox');
    const submitBtn = document.querySelector('button[type="submit"]');

    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu.');
        }
    });
});
</script>
@endpush
@endsection
