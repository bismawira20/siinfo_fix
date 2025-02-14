<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cpanel;
use App\Models\Aplikasi;
use App\Models\BukuTamu;
use App\Models\EmailDinas;
use App\Models\Passphrase;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bukutamu_diproses = BukuTamu::where('status', 'diproses')->count();
        $bukutamu_disetujui = BukuTamu::where('status', 'disetujui')->count();
        $bukutamu_ditolak = BukuTamu::where('status', 'ditolak')->count();

        $pengaduan_diproses = Pengaduan::where('status', 'diproses')->count();
        $pengaduan_disetujui = Pengaduan::where('status', 'disetujui')->count();
        $pengaduan_ditolak = Pengaduan::where('status', 'ditolak')->count();

        $aplikasi_diproses = Aplikasi::where('status', 'diproses')->count();
        $aplikasi_disetujui = Aplikasi::where('status','disetujui')->count();
        $aplikasi_ditolak = Aplikasi::where('status','ditolak')->count();

        $cpanel_diproses = Cpanel::where('status','diproses')->count();
        $cpanel_disetujui = Cpanel::where('status','disetujui')->count();
        $cpanel_ditolak = Cpanel::where('status','ditolak')->count();

        $emaildinas_diproses = EmailDinas::where('status','diproses')->count();
        $emaildinas_disetujui = EmailDinas::where('status','disetujui')->count();
        $emaildinas_ditolak = EmailDinas::where('status','ditolak')->count();

        $passphrase_diproses = Passphrase::where('status','diproses')->count();
        $passphrase_disetujui = Passphrase::where('status','disetujui')->count();
        $passphrase_ditolak = Passphrase::where('status','ditolak')->count();

        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $jumlahTanggal = BukuTamu::whereDate('tanggal', $tanggalSekarang)->count();


        return view('dashboard.index', compact('bukutamu_diproses', 'bukutamu_disetujui', 
        'bukutamu_ditolak', 'pengaduan_diproses', 'pengaduan_disetujui', 'pengaduan_ditolak',
        'aplikasi_diproses','aplikasi_disetujui','aplikasi_ditolak','cpanel_diproses',
        'cpanel_disetujui','cpanel_ditolak','emaildinas_diproses','emaildinas_disetujui','emaildinas_ditolak',
        'passphrase_diproses','passphrase_disetujui','passphrase_ditolak','jumlahTanggal'));
    }
}
