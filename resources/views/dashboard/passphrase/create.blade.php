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
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">
            Nama Lengkap Pemohon
        </label>
        <input type="text" class="form-control" 
        id="nama" name="nama">
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="nip_pemohon" class="form-label @error('nip_pemohon') is-invalid @enderror">NIP Pemohon
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nip_pemohon" name="nip_pemohon">
            @error('nip_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon
                <small class="form-text text-muted d-block">
                    (Usahakan terhubung Whatsapp, contoh : 0818824864)
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
            <label for="nama_user" class="form-label @error('nama_user') is-invalid @enderror">
                Nama User/Pemilik Akun
            </label>
            <input type="text" class="form-control" 
            id="nama_user" name="nama_user">
            @error('nama_user')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nik_user" class="form-label @error('nik_user') is-invalid @enderror">NIK User
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 33741103098720001)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nik_user" name="nik_user">
            @error('nik_user')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nip_user" class="form-label @error('nip_user') is-invalid @enderror">NIP User
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nip_user" name="nip_user">
            @error('nip_user')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email_domain" class="form-label @error('email_domain') is-invalid @enderror">
                Alamat Email User
                <small class="form-text text-muted d-block">
                    (Alamat email dengan domain @semarangkota.go.id, jika lupa/ belum memiliki 
                    silakan berkoordinasi dengan petugas terkait)
                </small>  
            </label>
            <input type="email" class="form-control" 
            id="email_domain" name="email_domain">
            @error('email_domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alasan" class="form-label @error('alasan') is-invalid @enderror">
                Alasan 
            </label>
            <textarea 
                class="form-control @error('alasan') is-invalid @enderror" 
                id="alasan" 
                name="alasan" 
                rows="4" 
                placeholder="Jelaskan alasan anda"
            >{{ old('alasan') }}</textarea>
            @error('alasan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- Terms and Conditions Section -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    Saya telah membaca dan menyetujui 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
                        Syarat dan Ketentuan
                    </a>
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
                {{-- Panggil komponen terms and conditions --}}
                @include('dashboard.layouts.terms_condition')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn btn-primary" id="acceptTermsBtn">Saya Setuju</button> --}}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('termsCheckbox');
    const submitBtn = document.getElementById('submitBtn');
    const acceptTermsBtn = document.getElementById('acceptTermsBtn');
    const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));

    // Tombol "Saya Setuju" di modal
    acceptTermsBtn.addEventListener('click', function() {
        termsCheckbox.checked = true;
        submitBtn.disabled = false;
        termsModal.hide();
    });

    // Checkbox terms
    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });

    // Prevent form submission if terms not accepted
    document.getElementById('pengajuanForm').addEventListener('submit', function(e) {
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu.');
        }
    });
});
</script>
@endpush
@endsection