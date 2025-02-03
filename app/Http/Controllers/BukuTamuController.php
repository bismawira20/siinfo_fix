<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BukuTamuController extends Controller
{
    public function index(){
        // return 'uji';
        $bukutamu = BukuTamu::where('user_id', Auth::id())
                         ->with('bidang') // Tambahkan eager loading
                         ->paginate(10);
        return view('dashboard.bukutamu.index', compact('bukutamu'));
    }

    public function create(){
        return view('dashboard.bukutamu.create',[
            'bidangs' =>Bidang::all()
        ]);
    }

    public function checkTanggal(Request $request)
    {
        $tanggal = $request->input('tanggal');

        // Cek apakah tanggal adalah hari Sabtu atau Minggu
        $carbonDate = Carbon::parse($tanggal);
        if ($carbonDate->isWeekend()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak dapat memilih hari Sabtu atau Minggu'
            ], 400);
        }

        // Hitung jumlah pendaftaran pada tanggal tersebut
        $count = DB::table('buku_tamus')
            ->where('tanggal', $tanggal)
            ->count();

        return response()->json([
            'status' => 'success',
            'count' => $count
        ]);
    }

    // Fungsi untuk mendapatkan opsi waktu yang tersedia
    public function getWaktuOptions(Request $request)
    {
        $tanggal = $request->input('tanggal');

        // Ambil waktu yang sudah dipilih pada tanggal tersebut
        $waktuTerpilih = DB::table('buku_tamus')
            ->where('tanggal', $tanggal)
            ->pluck('waktu');

        // Semua waktu yang tersedia
        $semuaWaktu = ['08:00', '10:00', '13:00'];

        // Filter waktu yang tersedia
        $waktuTersedia = array_values(array_diff($semuaWaktu, $waktuTerpilih->toArray()));

        return response()->json([
            'waktu_tersedia' => $waktuTersedia,
            'waktu_terpakai' => $waktuTerpilih->toArray()
        ]);
    }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'bidang_id' => 'required',
            'no_telp' => 'required|max:15',
            'instansi' => 'required|max:255',
            'tujuan' => 'required',
            'tanggal' => [
                'required', 
                'date', 
                function ($attribute, $value, $fail) {
                    // Cek apakah tanggal adalah hari kerja
                    $carbonDate = Carbon::parse($value);
                    if ($carbonDate->isWeekend()) {
                        $fail('Tanggal harus di hari kerja (Senin-Jumat)');
                    }

                    // Cek jumlah pendaftaran pada tanggal tersebut
                    $count = DB::table('buku_tamus')
                        ->where('tanggal', $value)
                        ->count();

                    if ($count >= 3) {
                        $fail('Tanggal sudah mencapai batas maksimum pendaftaran');
                    }
                },
            ],
            'waktu' => [
                'required', 
                'in:08:00,10:00,13:00',
                function ($attribute, $value, $fail) use ($request) {
                    // Cek apakah waktu sudah terpakai pada tanggal tersebut
                    $count = DB::table('buku_tamus')
                        ->where('tanggal', $request->input('tanggal'))
                        ->where('waktu', $value)
                        ->count();

                    if ($count > 0) {
                        $fail('Waktu sudah dipilih pada tanggal tersebut');
                    }
                },
            ],
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $validatedData['user_id'] = Auth::id();

        BukuTamu::create($validatedData);

        return redirect ('/dashboard/bukutamu')->with("success", "Agenda kunjungan berhasil ditambahkan!");
    }

    public function destroy(BukuTamu $bukutamu){
        BukuTamu::destroy($bukutamu->id);

        return redirect ('/dashboard/bukutamu')->with("success", "Agenda kunjungan berhasil dihapus!");

    }

    public function edit(BukuTamu $bukutamu){
        return view('dashboard.bukutamu.edit',[
            'bukutamu' => $bukutamu,
            'bidangs' =>Bidang::all()
        ]);
    }

    public function update(Request $request, BukuTamu $bukutamu)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'bidang_id' => 'required',
            'no_telp' => 'required|max:15',
            'instansi' => 'required|max:255',
            'tujuan' => 'required',
            'tanggal' => [
            'required', 
            'date', 
            function ($attribute, $value, $fail) use ($request, $bukutamu){
                // Cek apakah tanggal adalah hari kerja
                $carbonDate = Carbon::parse($value);
                if ($carbonDate->isWeekend()) {
                    $fail('Tanggal harus di hari kerja (Senin-Jumat)');
                }

                // Cek jumlah pendaftaran pada tanggal tersebut, kecuali untuk agenda yang sedang diupdate
                $count = DB::table('buku_tamus')
                    ->where('tanggal', $value)
                    ->where('id', '!=', $bukutamu->id) // Pastikan tidak menghitung agenda yang sedang diupdate
                    ->count();

                if ($count >= 3) {
                    $fail('Tanggal sudah mencapai batas maksimum pendaftaran');
                }
            },
        ],
        'waktu' => [
            'required', 
            'in:08:00,10:00,13:00',
            function ($attribute, $value, $fail) use ($request, $bukutamu) {
                // Cek apakah waktu sudah terpakai pada tanggal tersebut, kecuali untuk agenda yang sedang diupdate
                $count = DB::table('buku_tamus')
                    ->where('tanggal', $request->input('tanggal'))
                    ->where('waktu', $value)
                    ->where('id', '!=', $bukutamu->id) // Pastikan tidak menghitung agenda yang sedang diupdate
                    ->count();

                if ($count > 0) {
                    $fail('Waktu sudah dipilih pada tanggal tersebut.');
                }
            },
        ],
    ]);

        $validatedData['user_id'] = Auth::id();
        
        BukuTamu::where('id', $bukutamu->id)->update($validatedData);

        return redirect('/dashboard/bukutamu')->with("success", "Agenda kunjungan berhasil diupdate!");
    }

    public function adminIndex(Request $request){ 
        $bukutamu = BukuTamu::query();

        // Filter berdasarkan tanggal awal dan akhir
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $bukutamu->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->tanggal_awal)),
                date('Y-m-d 23:59:59', strtotime($request->tanggal_akhir))
            ]);
        }
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $bukutamu->where('status', $request->status);
        }

        // Filter by bidang
        if ($request->filled('bidang')) {
            $bukutamu->where('bidang_id', $request->bidang);
        }
    
        $bukutamu = $bukutamu->paginate(10)->withQueryString();
        
        $bidang = Bidang::all();
    
        return view('dashboard.bukutamu.admin.index', compact('bukutamu', 'bidang'));
    }

    public function setuju(BukuTamu $bukutamu){
        BukuTamu::where('id', $bukutamu->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/bukutamu/admin')->with("success", "Agenda kunjungan disetujui!");
    }

    public function tolak(BukuTamu $bukutamu){
        BukuTamu::where('id', $bukutamu->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/bukutamu/admin')->with("success", "Agenda kunjungan ditolak!");
    }

    public function setujuSemua(){
        BukuTamu::where('status', 'pending')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/bukutamu/admin')->with("success", "Agenda kunjungan disetujui!");
    }
}
