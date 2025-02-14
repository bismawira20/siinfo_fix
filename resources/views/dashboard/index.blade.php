@extends('dashboard.layouts.main')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

<style>
  .icon-box {
        background-color: #c079e1; /* Warna latar belakang kotak ikon */
        border-radius: 5px; /* Sudut melengkung */
        padding: 10px; /* Ruang di dalam kotak */
        display: flex; /* Menggunakan flexbox untuk menempatkan ikon di tengah */
        justify-content: center; /* Mengatur ikon agar berada di tengah */
        align-items: center; /* Mengatur ikon agar berada di tengah secara vertikal */
    }
  .icon-box-1 {
        background-color: #e17979; /* Warna latar belakang kotak ikon */
        border-radius: 5px; /* Sudut melengkung */
        padding: 10px; /* Ruang di dalam kotak */
        display: flex; /* Menggunakan flexbox untuk menempatkan ikon di tengah */
        justify-content: center; /* Mengatur ikon agar berada di tengah */
        align-items: center; /* Mengatur ikon agar berada di tengah secara vertikal */
    }
</style>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Selamat datang, {{ auth()->user()->name }}!</h1>
</div>

<div class="row mb-4">
  <div class="col-md-5">
    <div class="card text-center bg-light border shadow">
        <div class="card-body d-flex align-items-center">
            <div class="icon-box me-3">
              <i class="fas fa-home fa-2x" style="color: white;"></i>
            </div>
            <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                <h5 class="card-title mb-0">Kembali ke Beranda</h5>
            </a>
        </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card text-center bg-light border shadow">
        <div class="card-body d-flex align-items-center">
            <div class="icon-box-1 me-3">
              <i class="fas fa-book fa-2x" style="color: white;"></i>
            </div>
            <a href="{{ url('/berita') }}" class="text-decoration-none text-dark">
                <h5 class="card-title mb-0">Baca Berita</h5>
            </a>
        </div>
    </div>
  </div>
</div>

@can('admin')
<div class="row">
  <!-- Card 1 -->
  <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-users text-danger me-2"></i>
                  <h6 class="mb-0">Kunjungan</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
  </div>

  <!-- Card 2 -->
  <div class="col-md-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="fas fa-bullhorn text-danger me-2"></i>
                <h6 class="mb-0">Pengaduan</h6>
            </div>
            <hr>
            <div>
              <div class="d-flex justify-content-between">
                  <span>Diproses</span> <span class="text-warning fw-bold">10</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">5</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
              </div>
          </div>
        </div>
    </div>
  </div>

  <!-- Card 3 -->
    <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-network-wired text-danger me-2"></i>
                  <h6 class="mb-0">Hosting & VPS</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
    </div>

  <!-- Card 4 -->
    <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-at text-danger me-2"></i>
                  <h6 class="mb-0">Email Dinas</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
    </div>
  
</div>

<div class="row mt-3">
  <!-- Card 5 -->
  <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-lock text-danger me-2"></i>
                  <h6 class="mb-0">Pengajuan TTE</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
  </div>

  <!-- Card 6 -->
  <div class="col-md-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="fas fa-laptop text-danger me-2"></i>
                <h6 class="mb-0">Pembuatan Aplikasi</h6>
            </div>
            <hr>
            <div>
              <div class="d-flex justify-content-between">
                  <span>Diproses</span> <span class="text-warning fw-bold">10</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">5</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
              </div>
          </div>
        </div>
    </div>
  </div>

  <!-- Card 7 -->
    <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-lock-open text-danger me-2"></i>
                  <h6 class="mb-0">Passphrase TTE</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
    </div>

  <!-- Card 8 -->
    <div class="col-md-3">
      <div class="card shadow-sm">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-user text-danger me-2"></i>
                  <h6 class="mb-0">Pembuatan CPANEL</h6>
              </div>
              <hr>
              <div>
                <div class="d-flex justify-content-between">
                    <span>Diproses</span> <span class="text-warning fw-bold">10</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">5</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">2</span>
                </div>
            </div>
          </div>
      </div>
    </div>
  
</div>
@endcan

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection