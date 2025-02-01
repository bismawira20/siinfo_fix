@extends('layouts.main')
@section('container')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #red;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="{{ asset('backend/img/diskominfo.jpg') }}" style="width:100%">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="{{ asset('backend/img/presdanwapres.jpg') }}" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="{{ asset('backend/img/tugumuda.jpg') }}" style="width:100%">
  <div class="text">Caption Three</div>
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</body>
</html> 

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