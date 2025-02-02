@extends('layouts.main')
@section('container')
<div class="container">
    <h2 class="text-center mb-5">Layanan Diskominfo</h2>

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
                'body' => 'Butuh email dinas resmi @semarangkota.go.id? Hubungi kami untuk proses cepat dan mudah, serta komunikasi profesional.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>',
                'title' => 'Pengajuan TTE (Tanda Tangan Elektronik)',
                'body' => 'Perlu mengajukan Tanda Tangan Elektronik? Kami siap membantu Anda mendapatkan TTE dengan proses yang cepat dan mudah. Hubungi kami untuk informasi lebih lanjut dan mulailah menikmati kemudahan tanda tangan digital yang aman dan terpercaya.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>',
                'title' => 'Pembuatan dan Pengembangan Aplikasi',
                'body' => 'Ingin mengubah ide Anda menjadi aplikasi yang inovatif? Kami menyediakan layanan pembuatan dan pengembangan aplikasi yang profesional. Dari konsep hingga peluncuran, tim kami siap membantu Anda menciptakan aplikasi yang sesuai dengan kebutuhan dan visi Anda.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>',
                'title' => 'Reset Password Email/Passphrase TTE',
                'body' => 'Lupa password email atau passphrase TTE Anda? Jangan khawatir! Kami menyediakan layanan reset yang cepat dan aman. Hubungi tim kami untuk bantuan lebih lanjut dan dapatkan kembali akses Anda dengan mudah.'
            ],
            [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
                'title' => 'Pembuatan dan Reset Akun CPANEL',
                'body' => 'Butuh bantuan mereset akun website atau cPanel? Hubungi kami sekarang untuk pemulihan cepat dan aman.'
            ]
        ];
        @endphp

@foreach($services as $service)
<div class="col">
    <a href="/layanan" class="text-decoration-none">
        <div class="card h-100 shadow border-0 ">
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
    </a>
</div>
@endforeach
</div>

<h2 class="text-center mb-5">Berita Terbaru</h2>
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute bg-dark px-3 py-2 text-white" 
                style="background-color :rgba(0, 0, 0, 0.7)">
                <a href="/berita?category={{ $post->category->slug }}" class="text-white text-decoration-none">
                    {{ $post->category->name }}
                </a>
                </div>

                @if ($post->image)
                  <image src = "{{ asset('storage/'. $post->image) }}"
                  alt="{{ $post->category->name }}" class="img-fluid"></image>
                @else
                <img src="https://picsum.photos/seed/office/500/500"
                class="card-img-top" alt="{{ $post->category->name }}">
                @endif

                <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p>
                    <small class="text-body-secondary">
                    by <a href="/berita?authors={{$post->user->username}}" class="text-decoration-none"> 
                    {{$post->user->name}}</a>
                    {{ $post->created_at->format('d F Y') }}
                    </small>
                </p>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="/posts/{{$post->slug}}" class="btn btn-danger">Baca Selanjutnya</a>
                </div>
            </div>
        </div>     
        @endforeach
    </div>
</div>
</div>
@endsection