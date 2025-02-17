<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cpanel;
use App\Models\Domain;
use App\Models\Aplikasi;
use App\Models\BukuTamu;
use App\Models\Pengaduan;
use App\Models\Pengajuan;
use App\Models\EmailDinas;
use App\Models\Passphrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        $bukutamu_diproses = BukuTamu::where('status', 'diproses')->count();
        $bukutamu_disetujui = BukuTamu::where('status', 'disetujui')->count();
        $bukutamu_ditolak = BukuTamu::where('status', 'ditolak')->count();

        $bukutamu_diproses_user = BukuTamu::where('status', 'diproses')->where('user_id', $userId)->count();
        $bukutamu_disetujui_user = BukuTamu::where('status', 'disetujui')->where('user_id', $userId)->count();
        $bukutamu_ditolak_user = BukuTamu::where('status', 'ditolak')->where('user_id', $userId)->count();

        $pengaduan_diproses = Pengaduan::where('status', 'diproses')->count();
        $pengaduan_disetujui = Pengaduan::where('status', 'disetujui')->count();
        $pengaduan_ditolak = Pengaduan::where('status', 'ditolak')->count();

        $pengaduan_diproses_user = Pengaduan::where('status', 'diproses')->where('user_id', $userId)->count();
        $pengaduan_disetujui_user = Pengaduan::where('status', 'disetujui')->where('user_id', $userId)->count();
        $pengaduan_ditolak_user = Pengaduan::where('status', 'ditolak')->where('user_id', $userId)->count();

        $aplikasi_diproses = Aplikasi::where('status', 'diproses')->count();
        $aplikasi_disetujui = Aplikasi::where('status','disetujui')->count();
        $aplikasi_ditolak = Aplikasi::where('status','ditolak')->count();

        $aplikasi_diproses_user = Aplikasi::where('status', 'diproses')->where('userid', $userId)->count();
        $aplikasi_disetujui_user = Aplikasi::where('status','disetujui')->where('userid', $userId)->count();
        $aplikasi_ditolak_user = Aplikasi::where('status','ditolak')->where('userid', $userId)->count();

        $cpanel_diproses = Cpanel::where('status','diproses')->count();
        $cpanel_disetujui = Cpanel::where('status','disetujui')->count();
        $cpanel_ditolak = Cpanel::where('status','ditolak')->count();

        $cpanel_diproses_user = Cpanel::where('status','diproses')->where('user_id', $userId)->count();
        $cpanel_disetujui_user = Cpanel::where('status','disetujui')->where('user_id', $userId)->count();
        $cpanel_ditolak_user = Cpanel::where('status','ditolak')->where('user_id', $userId)->count();

        $emaildinas_diproses = EmailDinas::where('status','diproses')->count();
        $emaildinas_disetujui = EmailDinas::where('status','disetujui')->count();
        $emaildinas_ditolak = EmailDinas::where('status','ditolak')->count();

        $emaildinas_diproses_user = EmailDinas::where('status','diproses')->where('user_id', $userId)->count();
        $emaildinas_disetujui_user = EmailDinas::where('status','disetujui')->where('user_id', $userId)->count();
        $emaildinas_ditolak_user = EmailDinas::where('status','ditolak')->where('user_id', $userId)->count();

        $passphrase_diproses = Passphrase::where('status','diproses')->count();
        $passphrase_disetujui = Passphrase::where('status','disetujui')->count();
        $passphrase_ditolak = Passphrase::where('status','ditolak')->count();

        $passphrase_diproses_user = Passphrase::where('status','diproses')->where('user_id', $userId)->count();
        $passphrase_disetujui_user = Passphrase::where('status','disetujui')->where('user_id', $userId)->count();
        $passphrase_ditolak_user = Passphrase::where('status','ditolak')->where('user_id', $userId)->count();

        $domain_diproses = Domain::where('status','diproses')->count();
        $domain_disetujui = Domain::where('status','disetujui')->count();
        $domain_ditolak = Domain::where('status','ditolak')->count();

        $domain_diproses_user = Domain::where('status','diproses')->where('userid', $userId)->count();
        $domain_disetujui_user = Domain::where('status','disetujui')->where('userid', $userId)->count();
        $domain_ditolak_user = Domain::where('status','ditolak')->where('userid', $userId)->count();

        $pengajuan_diproses = Pengajuan::where('status','diproses')->count();
        $pengajuan_disetujui = Pengajuan::where('status','disetujui')->count();
        $pengajuan_ditolak = Pengajuan::where('status','ditolak')->count();

        $pengajuan_diproses_user = Pengajuan::where('status','diproses')->where('user_id', $userId)->count();
        $pengajuan_disetujui_user = Pengajuan::where('status','disetujui')->where('user_id', $userId)->count();
        $pengajuan_ditolak_user = Pengajuan::where('status','ditolak')->where('user_id', $userId)->count();

        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $jumlahTanggal = BukuTamu::whereDate('tanggal', $tanggalSekarang)->count();


        return view('dashboard.index', compact('bukutamu_diproses', 'bukutamu_disetujui', 
        'bukutamu_ditolak', 'pengaduan_diproses', 'pengaduan_disetujui', 'pengaduan_ditolak',
        'aplikasi_diproses','aplikasi_disetujui','aplikasi_ditolak','cpanel_diproses',
        'cpanel_disetujui','cpanel_ditolak','emaildinas_diproses','emaildinas_disetujui','emaildinas_ditolak',
        'passphrase_diproses','passphrase_disetujui','passphrase_ditolak',
        'domain_diproses','domain_disetujui','domain_ditolak',
        'pengajuan_diproses','pengajuan_disetujui','pengajuan_ditolak','jumlahTanggal', 
        'bukutamu_diproses_user', 'bukutamu_disetujui_user', 'bukutamu_ditolak_user',
        'pengaduan_diproses_user', 'pengaduan_disetujui_user', 'pengaduan_ditolak_user',
        'aplikasi_diproses_user','aplikasi_disetujui_user','aplikasi_ditolak_user', 'cpanel_diproses_user',
        'cpanel_disetujui_user','cpanel_ditolak_user',
        'emaildinas_diproses_user','emaildinas_disetujui_user','emaildinas_ditolak_user',
        'passphrase_diproses_user','passphrase_disetujui_user','passphrase_ditolak_user',
        'domain_diproses_user','domain_disetujui_user','domain_ditolak_user',
        'pengajuan_diproses_user','pengajuan_disetujui_user','pengajuan_ditolak_user' ));
    }
}
