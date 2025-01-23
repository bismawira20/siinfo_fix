@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Akses Cpanel Aplikasi di Pemkot</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/cpanel/{{ $cpanel->id }}/update" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
        <div class="mb-3">
        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Pemohon</label>
        <input type="text" class="form-control" 
        id="nama" name="nama" value ="{{ old('nama', $cpanel->nama) }}">
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif! Contoh : 0818824864)
                </small> 
            </label>
            <input type="tel" class="form-control" 
            id="no_telp" name="no_telp" value ="{{ old('no_telp', $cpanel->no_telp) }}">
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP/ID non ASN
            <small class="form-text text-muted d-block">
                (Tanpa spasi, tanpa tanda baca, misal 198709032018021002)
            </small>
            </label>
            <input type="text" class="form-control" 
            id="nip" name="nip" value ="{{ old('nip', $cpanel->nip) }}">
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">
                Jabatan 
            </label>
            <input type="text" class="form-control" 
            id="jabatan" name="jabatan" value ="{{ old('jabatan', $cpanel->jabatan) }}">
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="asal_opd" class="form-label @error('asal_opd') 
            is-invalid @enderror">Asal OPD</label>
            <input type="text" class="form-control" 
            id="asal_opd" name="asal_opd" value ="{{ old('asal_opd', $cpanel->asal_opd) }}">
            @error('asal_opd')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="url" class="form-label @error('url') is-invalid @enderror">
                URL Applikasi
                <small class="form-text text-muted d-block">
                    (Contoh: bongsari.semarangkota.go.id)
                </small> 
            </label>
            <input type="text" class="form-control" 
            id="url" name="url" value ="{{ old('url', $cpanel->url) }}">
            @error('url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="file" class="form-label @error('file') is-invalid @enderror">Surat Tugas Pengambilan Berita Acara
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/1yMXzjmWdXelyIk06wam9qMPnrTlvFoiZ4cdaX7eW8oM/edit?usp=sharing">
                        disini</a>(.pdf maksimal 5MB))
                </small> 
            </label>
            <input class="form-control" type="file" id="file" name="file" value ="{{ old('file', $cpanel->file) }}">
            @error('file')
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