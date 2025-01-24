@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@section('container')
<div class="container">
    <h2 class="text-center mb-5">Layanan Diskominfo Kota Semarang</h2>

    {{-- Card Layanan --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @php
        $services = [
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>',
                'title' => 'Sub Domain dan VPS Kota Semarang', 
                'body' => 'Butuh sub domain, hosting, atau VPS yang handal? Kami menyediakan layanan lengkap untuk kebutuhan web Anda. Dapatkan performa terbaik dan dukungan penuh dari tim ahli kami. Hubungi kami sekarang untuk solusi web yang profesional dan terpercaya.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
                'title' => 'Pembuatan Email Dinas',
                'body' => 'Pembuatan email resmi untuk pegawai di lingkungan pemerintahan Kota Semarang.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>',
                'title' => 'Pengajuan TTE (Tanda Tangan Elektronik)',
                'body' => 'Layanan pengajuan dan penerbitan Tanda Tangan Elektronik resmi.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>',
                'title' => 'Pembuatan dan Pengembangan Aplikasi',
                'body' => 'Layanan konsultasi, pembuatan, dan pengembangan aplikasi untuk kebutuhan pemerintahan.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>',
                'title' => 'Reset Password Email/Passphrase TTE',
                'body' => 'Layanan reset password email dinas atau passphrase Tanda Tangan Elektronik.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
                'title' => 'Pembuatan dan Reset Akun CPANEL',
                'body' => 'Layanan pembuatan akun baru atau reset akun kontrol panel untuk keperluan internal.'
            ]
        ];
        @endphp
    
        @foreach($services as $service)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger">
                            {!! $service['svg'] !!}
                        </svg>
                    </div>
                    <h5 class="card-title mb-3">{{ $service['title'] }}</h5>
                    <p class="card-text text-muted">{{ $service['body'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Penjelasan Layanan --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Prosedur Mengakses Layanan</h3>
            <hr class="mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Login atau Registrasi</div>
                                Bagi pengguna yang sudah memiliki akun, silakan login. 
                                Bagi pengguna baru, lakukan registrasi terlebih dahulu.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Masuk Dashboard</div>
                                Setelah login, Anda akan diarahkan ke dashboard masing-masing user.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Pilih Menu Layanan</div>
                                Navigasikan ke menu layanan yang tersedia di dashboard.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Tambah Layanan</div>
                                Pilih layanan yang ingin Anda gunakan dan klik tombol tambah.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Tunggu Proses Verifikasi</div>
                                Tunggu status layanan hingga diproses oleh admin.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Notifikasi</div>
                                Cek WhatsApp atau email Anda untuk informasi lebih lanjut.
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-body svg {
        stroke: currentColor;
        width: 64px;
        height: 64px;
    }
</style>
@endsection
