@extends('dashboard.layouts.main')

{{-- CSS dan JS --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Ajukan Pembuatan Aplikasi</h2>
</div>

<div class="col-lg-7">
    <form method="post" action="/dashboard/aplikasi/{{ $aplikasi->id }}/update" 
    enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
        <div class="mb-3">
            <h6>Data Diri</h6>
        </div>
        <div class="mb-3">
        <label for="nip" class="form-label @error('nip') is-invalid @enderror">NIP</label>
        <input type="text" class="form-control" 
        id="nip" name="nip" value = {{ old('nip', $aplikasi->nip) }}>
        @error('nip')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="nama_pic" class="form-label @error('nama_pic') is-invalid @enderror">Nama PIC</label>
            <input type="text" class="form-control" 
            id="nama_pic" name="nama_pic" value = {{ old('nama_pic', $aplikasi->nama_pic) }}>
            @error('nama_pic')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
            <input type="text" class="form-control" 
            id="jabatan" name="jabatan" value = {{ old('jabatan', $aplikasi->jabatan) }}>
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="opd" class="form-label @error('opd') is-invalid @enderror">OPD</label>
            <input type="text" class="form-control" 
            id="opd" name="opd" value = {{ old('opd', $aplikasi->opd) }}>
            @error('opd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
            <input type="email" class="form-control" 
            id="email" name="email" value = {{ old('email', $aplikasi->email) }}>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label @error('no_telp') is-invalid @enderror">
                Nomor Telepon PIC
                <small class="form-text text-muted d-block">
                    (Whatsapp Aktif! Contoh : 0818824864)
                </small> 
            </label>
            <input type="tel" class="form-control" 
            id="no_telp" name="no_telp" value = {{ old('no_telp', $aplikasi->no_telp) }}>
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Deskripsi Aplikasi</h6>
        </div>
        <div class="mb-3">
            <label for="nama_app" class="form-label @error('nama_app') is-invalid @enderror">Usulan Nama Applikasi</label>
            <input type="text" class="form-control" 
            id="nama_app" name="nama_app" value = {{ old('nama_app', $aplikasi->nama_app) }}>
            @error('nama_app')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Aplikasi</label>
            <textarea 
                class="form-control @error('deskripsi') is-invalid @enderror" 
                name="deskripsi" 
                id="deskripsi" 
                rows="5" 
                placeholder="Masukkan deskripsi aplikasi"
            >{{ old('deskripsi', $aplikasi->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Aplikasi</label>
            <select class="form-select @error('tipe') is-invalid @enderror" name="tipe">
                <option selected disabled>Silahkan Pilih Tipe Aplikasi</option>
                <option value="Android" {{ old('tipe', isset($aplikasi) ? $aplikasi->tipe : '') == 'Android' ? 'selected' : '' }}>Android</option>
                <option value="Berbasis Web" {{ old('tipe', isset($aplikasi) ? $aplikasi->tipe : '') == 'Berbasis Web' ? 'selected' : '' }}>Berbasis Web</option>
                <option value="Desktop" {{ old('tipe', isset($aplikasi) ? $aplikasi->tipe : '') == 'Desktop' ? 'selected' : '' }}>Desktop</option>
            </select>
            @error('tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
            <input type="number" class="form-control @error('tahun_pembuatan') is-invalid @enderror" name="tahun_pembuatan" 
                   min="2020" max="{{ date('Y') }}" placeholder="Masukkan Tahun Pembuatan" value = {{ old('tahun_pembuatan', $aplikasi->tahun_pembuatan) }}>
            @error('tahun_pembuatan')
                <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="bahasa_pemograman" class="form-label">Bahasa Pemrograman</label>
            <input type="text" class="form-control @error('bahasa_pemograman') is-invalid @enderror" name="bahasa_pemograman" 
                   placeholder="Contoh: PHP, Java, Python" value = {{ old('bahasa_pemograman', $aplikasi->bahasa_pemograman) }}>
            @error('bahasa_pemograman')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="framework" class="form-label">Framework</label>
            <input type="text" class="form-control @error('framework') is-invalid @enderror" name="framework" 
                   placeholder="Contoh: Laravel, CodeIgniter, React" value = {{ old('framework', $aplikasi->framework) }}>
            @error('framework')
                <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="database" class="form-label">Database</label>
            <input type="text" class="form-control @error('database') is-invalid @enderror" name="database" 
                   placeholder="Contoh: MySQL, PostgreSQL, MongoDB" value = {{ old('database', $aplikasi->database) }}>
            @error('database')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>
        <div class="mb-3">
            <label for="sistem_operasi" class="form-label">Sistem Operasi</label>
            <input type="text" class="form-control @error('sistem_operasi') is-invalid @enderror" name="sistem_operasi" 
                   placeholder="Contoh: Windows, Linux, macOS" value = {{ old('sistem_operasi', $aplikasi->sistem_operasi) }}>
            @error('sistem_operasi')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="instalasi" class="form-label">Lokasi Instalasi</label>
            <select class="form-select @error('instalasi') is-invalid @enderror" name="instalasi">
                <option selected disabled>Pilih Lokasi Instalasi</option>
                <option value="Data Center Diskominfo Kota Semarang" 
                    {{ old('instalasi', isset($aplikasi) ? $aplikasi->instalasi : '') == 'Data Center Diskominfo Kota Semarang' ? 'selected' : '' }}>
                    Data Center Diskominfo Kota Semarang
                </option>
                <option value="Server OPD" 
                    {{ old('instalasi', isset($aplikasi) ? $aplikasi->instalasi : '') == 'Server OPD' ? 'selected' : '' }}>
                    Server OPD
                </option>
                <option value="Server Pihak Ketiga" 
                    {{ old('instalasi', isset($aplikasi) ? $aplikasi->instalasi : '') == 'Server Pihak Ketiga' ? 'selected' : '' }}>
                    Server Pihak Ketiga
                </option>
            </select>
            @error('instalasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-5 mb-3">
            <h6>Data Dukung</h6>
        </div>

        <div class="mb-3">
            <label for="dokumen" class="form-label @error('dokumen') is-invalid @enderror">Data Dukung
                <small class="form-text text-muted d-block"> Wajib upload surat permohonan resmi bertandatangan kepala OPD & Proses Bisnis Aplikasi</small> 
            </label>
            <input class="form-control" type="file" id="dokumen" name="dokumen">
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection