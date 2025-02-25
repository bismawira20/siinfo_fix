<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use App\Exports\ExportBukuTamu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            'nama' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'bidang_id' => 'required',
            'no_telp' => [
                'required',
                'max:15',
                'regex:/^[0-9]+$/', // Hanya angka
            ],
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
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'nama.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
            'bidang_id.required' => 'Bidang harus dipilih.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
            'no_telp.regex' => 'Nomor telepon hanya boleh mengandung angka.',
            'instansi.required' => 'Instansi harus diisi.',
            'instansi.max' => 'Instansi tidak boleh lebih dari 255 karakter.',
            'tujuan.required' => 'Tujuan harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'waktu.required' => 'Waktu harus dipilih.',
            'waktu.in' => 'Waktu yang dipilih tidak valid.',
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
        //Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $bukutamu->where('tanggal', $request->tanggal);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $bukutamu->where('status', $request->status);
        }

        // Filter by bidang
        if ($request->filled('bidang')) {
            $bukutamu->where('bidang_id', $request->bidang);
        }
    
        $bukutamu = $bukutamu->paginate(10);
        
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

    public function adminShow(BukuTamu $bukutamu){
        return view('dashboard.bukutamu.admin.show',[
            'bukutamu' => $bukutamu
        ]);
    }

    public function adminTanggapi(BukuTamu $bukutamu){
        return view('dashboard.bukutamu.admin.tanggapan',[
            'bukutamu' => $bukutamu
        ]);
    }

    public function adminUpdate(Request $request, BukuTamu $bukutamu)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan bukutamu
        $bukutamu->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/bukutamu/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }

    public function export_excel(){
        return Excel::download(new ExportBukuTamu, 'kunjungan.xlsx');
    }
}
