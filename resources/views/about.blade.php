@extends('layouts.main')

@section('container')
    <head>
        <style>
            .contact-container {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
            }
            .contact-info {
                flex: 1;
                padding: 20px;
            }
            .contact-info h1 {
                color: #333;
                margin-bottom: 20px;
            }
            .contact-info p {
                color: #555;
                font-size: 16px;
                margin: 10px 0;
            }
            .social-icons {
                display: flex;
                gap: 15px;
                margin: 15px 0;
            }
            .social-icons a {
                text-decoration: none;
                color: #555;
                font-size: 24px;
            }
            .map-container {
            flex: 1;
            margin-left: 20px;
            border-radius: 10px;
            overflow: hidden;
            height: 400px; 
            }
            iframe {
                width: 100%; 
                height: 100%; 
                border: 0;
            }
        </style>
    </head>
    
    <body>
        <div class="contact-container">
            <!-- Informasi Kontak -->
            <div class="contact-info">
                <h1>Kontak Kami</h1>
                <p>Hubungi kami untuk informasi lebih lanjut atau pertanyaan terkait layanan kami. Tim kami siap memberikan bantuan yang Anda butuhkan.</p>
    
                <div class="social-icons">
                    <a href="https://www.facebook.com/diskominfokotasemarang/?paipv=0&eav=AfahS3KPIIclS0W8CPlXJ-GYW5_ZKRVtIb8_l94u8ev-77zAfZlIOJST6U6Ifd3L9LM&_rdr" target="_blank" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/diskominfokotasemarang?igsh=ZDNlZDc0MzIxNw%3D%3D" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://x.com/kominfokotasmg" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.youtube.com/@semarangpemkot" target="_blank" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
    
    
                <p><strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                  </svg></strong> &nbsp &nbsp diskominfo@semarangkota.go.id</p>
                <p><strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                  </svg></strong> &nbsp &nbsp Jl. Pemuda No.148, Kota Semarang, Jawa Tengah 50132</p>
            </div>
    
            <!-- Peta Lokasi -->
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15840.793492617235!2d110.4142924!3d-6.98589825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4fd277d06b%3A0x4056bfa9e8303c06!2sDinas%20Kominfo%20Kota%20Semarang!5e0!3m2!1sid!2sid!4v1721794012651!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
    
        </div>
    </body>
@endsection