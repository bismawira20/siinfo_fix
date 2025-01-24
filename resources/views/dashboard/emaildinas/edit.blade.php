@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Email Dinas</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/emaildinas/{{ $emaildinas->id }}/update" 
    enctype="multipart/form-data" class="mb-5" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
        <label for="nama_opd" class="form-label @error('nama_opd') is-invalid @enderror">Nama OPD</label>
        <input type="text" class="form-control" 
        id="nama_opd" name="nama_opd" value ="{{ old('nama_opd', $emaildinas->nama_opd) }}">
        @error('nama_opd')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <input type="text" class="form-control" 
            id="nama_pic" name="nama_pic" value ="{{ old('nama_pic', $emaildinas->nama_pic) }}">
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        <div class="mb-3">
            <label for="no_telp_pic" class="form-label @error('no_telp_pic') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif PIC! Contoh : 0818824864)
                </small> 
            </label>
            <input type="tel" class="form-control" 
            id="no_telp_pic" name="no_telp_pic" value ="{{ old('no_telp_pic', $emaildinas->no_telp_pic) }}">
            @error('no_telp_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="surat_rekomendasi" class="form-label @error('surat_rekomendasi') is-invalid @enderror">Surat Permohonan Rekomendasi Pembuatan Email
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/19eoa5WC2NGI7UhNAQzETs-tT7JQLh7BWJIJMmqgxRoQ/edit?usp=sharing"
                    target="_blank" rel="noopener noreferrer">disini</a> (.pdf maksimal 1MB))
                </small> 
            </label>
            <input class="form-control" type="file" id="surat_rekomendasi" name="surat_rekomendasi" value ="{{ old('surat_rekomendasi', $emaildinas->surat_rekomendasi) }}">
            @error('surat_rekomendasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="form_pengajuan" class="form-label @error('form_pengajuan') is-invalid @enderror">Formulir Pengajuan Pembuatan Email
                <small class="form-text text-muted d-block">
                    (Contoh template klik <a href="https://docs.google.com/document/d/1vQjLyRwKNN1BscENI4SvQtT2CcpdnLZOg2jyGAzqRAA/edit?usp=sharing"
                    target="_blank" rel="noopener noreferrer">disini</a> (.pdf maksimal 1MB))
                </small> 
            </label>
            <input class="form-control" type="file" id="form_pengajuan" name="form_pengajuan" value ="{{ old('form_pengajuan', $emaildinas->form_pengajuan) }}">
            @error('form_pengajuan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3 text-center">
            <h6>Pemohon</h6>
            <p class="text-muted">
                Minimal terdapat satu pemohon. Silakan tuliskan nama lengkap tanpa gelar.
            </p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="nama_pemohon" class="form-label  @error('nama_pemohon') is-invalid @enderror">Nama Pemohon
                </label>
                <input type="text" class="form-control  @error('nama_pemohon') is-invalid @enderror" 
                       id="nama_pemohon" name="nama_pemohon" value ="{{ old('nama_pemohon', $emaildinas->nama_pemohon) }}">
                @error('nama_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="nip_pemohon" class="form-label @error('nip_pemohon') is-invalid @enderror">NIP Pemohon
                </label>
                <input type="text" class="form-control @error('nip_pemohon') is-invalid @enderror" 
                       id="nip_pemohon" name="nip_pemohon" value ="{{ old('nip_pemohon', $emaildinas->nip_pemohon) }}">
                @error('nip_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="no_telp_pemohon" class="form-label @error('no_telp_pemohon') is-invalid @enderror">No. WA Pemohon</label>
                <input type="text" class="form-control @error('no_telp_pemohon') is-invalid @enderror" 
                       id="no_telp_pemohon" name="no_telp_pemohon" value ="{{ old('no_telp_pemohon', $emaildinas->no_telp_pemohon) }}">
                @error('no_telp_pemohon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control  @error('nama_2') is-invalid @enderror" 
                       id="nama_2" name="nama_2" value ="{{ old('nama_2', $emaildinas->nama_2) }}">
                @error('nama_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('nip_2') is-invalid @enderror" 
                       id="nip_2" name="nip_2" value ="{{ old('nip_2', $emaildinas->nip_2) }}">
                @error('nip_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('no_telp_2') is-invalid @enderror" 
                       id="no_telp_2" name="no_telp_2" value ="{{ old('no_telp_2', $emaildinas->no_telp_2) }}">
                @error('no_telp_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control  @error('nama_3') is-invalid @enderror" 
                       id="nama_3" name="nama_3" value ="{{ old('nama_3', $emaildinas->nama_3) }}">
                @error('nama_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('nip_3') is-invalid @enderror" 
                       id="nip_3" name="nip_3" value ="{{ old('nip_3', $emaildinas->nip_3) }}">
                @error('nip_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('no_telp_3') is-invalid @enderror" 
                       id="no_telp_3" name="no_telp_3" value ="{{ old('no_telp_3', $emaildinas->no_telp_3) }}">
                @error('no_telp_3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control  @error('nama_4') is-invalid @enderror" 
                       id="nama_4" name="nama_4" value ="{{ old('nama_4', $emaildinas->nama_4) }}">
                @error('nama_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('nip_4') is-invalid @enderror" 
                       id="nip_4" name="nip_4" value ="{{ old('nip_4', $emaildinas->nip_4) }}">
                @error('nip_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('no_telp_4') is-invalid @enderror" 
                       id="no_telp_4" name="no_telp_4" value ="{{ old('no_telp_4', $emaildinas->no_telp_4) }}">
                @error('no_telp_4')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control  @error('nama_5') is-invalid @enderror" 
                       id="nama_5" name="nama_5" value ="{{ old('nama_5', $emaildinas->nama_5) }}">
                @error('nama_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('nip_5') is-invalid @enderror" 
                       id="nip_5" name="nip_5" value ="{{ old('nip_5', $emaildinas->nip_5) }}">
                @error('nip_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control @error('no_telp_5') is-invalid @enderror" 
                       id="no_telp_5" name="no_telp_5" value ="{{ old('no_telp_5', $emaildinas->no_telp_5) }}">
                @error('no_telp_5')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
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
                @include('dashboard.layouts.terms_condition_email')
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