@extends('dashboard.layouts.main')

@section('container')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    .icon-box-2 {
        background-color: #8ce179; /* Warna latar belakang kotak ikon */
        border-radius: 5px; /* Sudut melengkung */
        padding: 10px; /* Ruang di dalam kotak */
        display: flex; /* Menggunakan flexbox untuk menempatkan ikon di tengah */
        justify-content: center; /* Mengatur ikon agar berada di tengah */
        align-items: center; /* Mengatur ikon agar berada di tengah secara vertikal */
    }
</style>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Selamat datang, {{ auth()->user()->name }}!</h1>
</div>

<div class="row mb-4">
  <div class="col-md-4">
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
  <div class="col-md-4">
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
  <div class="col-md-4">
    <div class="card text-center bg-light border shadow">
        <div class="card-body d-flex align-items-center">
            <div class="icon-box-2 me-3">
              <i class="fas fa-user fa-2x" style="color: white;"></i>
            </div>
                <h5 class="card-title mb-0">{{ $jumlahTanggal }} Kunjungan Hari Ini</h5>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $bukutamu_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $bukutamu_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $bukutamu_ditolak }}</span>
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
                  <span>Diproses</span> <span class="text-warning fw-bold">{{ $pengaduan_diproses }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">{{ $pengaduan_disetujui }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">{{ $pengaduan_ditolak }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $domain_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $domain_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $domain_ditolak }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $emaildinas_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $emaildinas_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $emaildinas_ditolak }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $pengajuan_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $pengajuan_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $pengajuan_ditolak }}</span>
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
                  <span>Diproses</span> <span class="text-warning fw-bold">{{ $aplikasi_diproses }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">{{ $aplikasi_disetujui }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">{{ $aplikasi_ditolak }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $passphrase_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $passphrase_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $passphrase_ditolak }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $cpanel_diproses }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $cpanel_disetujui }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $cpanel_ditolak }}</span>
                </div>
            </div>
          </div>
      </div>
    </div>
  
</div>
@endcan

@can('user')
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
                      <span>Diproses</span> <span class="text-warning fw-bold">{{ $bukutamu_diproses_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Disetujui</span> <span class="text-success fw-bold">{{ $bukutamu_disetujui_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Ditolak</span> <span class="text-danger fw-bold">{{ $bukutamu_ditolak_user }}</span>
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
                  <span>Diproses</span> <span class="text-warning fw-bold">{{ $pengaduan_diproses_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">{{ $pengaduan_disetujui_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">{{ $pengaduan_ditolak_user }}</span>
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
                  <span>Diproses</span> <span class="text-warning fw-bold">{{ $domain_diproses_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">{{ $domain_disetujui_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">{{ $domain_ditolak_user }}</span>
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
                  <span>Diproses</span> <span class="text-warning fw-bold">{{ $emaildinas_diproses_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Disetujui</span> <span class="text-success fw-bold">{{ $emaildinas_disetujui_user }}</span>
              </div>
              <div class="d-flex justify-content-between">
                  <span>Ditolak</span> <span class="text-danger fw-bold">{{ $emaildinas_ditolak_user }}</span>
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
                      <span>Diproses</span> <span class="text-warning fw-bold">{{ $pengajuan_diproses_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Disetujui</span> <span class="text-success fw-bold">{{ $pengajuan_disetujui_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Ditolak</span> <span class="text-danger fw-bold">{{ $pengajuan_ditolak_user }}</span>
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
                    <span>Diproses</span> <span class="text-warning fw-bold">{{ $aplikasi_diproses_user }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Disetujui</span> <span class="text-success fw-bold">{{ $aplikasi_disetujui_user }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ditolak</span> <span class="text-danger fw-bold">{{ $aplikasi_ditolak_user }}</span>
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
                      <span>Diproses</span> <span class="text-warning fw-bold">{{ $passphrase_diproses_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Disetujui</span> <span class="text-success fw-bold">{{ $passphrase_disetujui_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Ditolak</span> <span class="text-danger fw-bold">{{ $passphrase_ditolak_user }}</span>
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
                      <span>Diproses</span> <span class="text-warning fw-bold">{{ $cpanel_diproses_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Disetujui</span> <span class="text-success fw-bold">{{ $cpanel_disetujui_user }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                      <span>Ditolak</span> <span class="text-danger fw-bold">{{ $cpanel_ditolak_user }}</span>
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