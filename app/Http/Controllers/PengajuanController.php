<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index(){
        // return 'uji';
        $pengajuan = Pengajuan::where('user_id', Auth::id())
                         ->paginate(10);
        return view('dashboard.pengajuan.index', compact('pengajuan'));
    }

    public function create(){
        return view('dashboard.pengajuan.create',[
            
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => [
                'required', 
                'max:20', 
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'nip' => [
                'required', 
                'regex:/^[0-9]+$/',
                'digits:18', // Hanya angka
            ],
            'nik' => [
                'required', 
                'regex:/^[0-9]+$/',
                'digits:16', // Hanya angka
            ],
            'nama_opd' => 'required|max:255',
            'no_telp' => 'required|max:15|digits_between:10,15',
            'email_domain' => [
                'required', 
                'email', 
                'regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/'
            ],    
            'jabatan' => 'required'
        ]);

        $validatedData['user_id'] = Auth::id();

        Pengajuan::create($validatedData);

        return redirect ('/dashboard/pengajuan')->with("success", "Pengajuan TTE berhasil ditambahkan!");
    }

    // public function destroy(Pengajuan $pengajuan){
    //     Pengajuan::destroy($pengajuan->id);

    //     return redirect ('/dashboard/pengajuan')->with("success", "Pengajuan TTE berhasil dihapus!");

    // }

    // public function edit(Pengajuan $pengajuan){
    //     return view('dashboard.pengajuan.edit',[
    //         'pengajuan' => $pengajuan,
    //     ]);
    // }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $validatedData = $request->validate([
            'nama' => [
                'required', 
                'max:20', 
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'nip' => [
                'required', 
                'regex:/^[0-9]+$/',
                'digits:18', // Hanya angka
            ],
            'nik' => [
                'required', 
                'regex:/^[0-9]+$/',
                'digits:16', // Hanya angka
            ],
            'nama_opd' => 'required|max:255',
            'no_telp' => 'required|max:15|digits_between:10,15',
            'email_domain' => [
                'required', 
                'email', 
                'regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/'
            ],    
            'jabatan' => 'required'
        ]);

        $validatedData['user_id'] = Auth::id();
        
        Pengajuan::where('id', $pengajuan->id)->update($validatedData);

        return redirect('/dashboard/pengajuan')->with("success", "Pengajuan TTE berhasil diupdate!");
    }

    // Admin
    public function adminIndex(Request $request) {
        $pengajuan = Pengajuan::query();
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $pengajuan->where('status', $request->status);
        }

        $pengajuan = $pengajuan->paginate(10);

        return view('dashboard.pengajuan.admin.index', compact('pengajuan'));
    }

    public function adminTanggapan(Pengajuan $pengajuan){
        return view('dashboard.pengajuan.admin.tanggapan',[
            'pengajuan' => $pengajuan 
        ]);
    }

    public function adminShow(Pengajuan $pengajuan){
        return view('dashboard.pengajuan.admin.show',[
            'pengajuan' => $pengajuan
        ]);
    }

    public function adminUpdate(Request $request, Pengajuan $pengajuan)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan pengaduan
        $pengajuan->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/pengajuan/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }

    public function selesai(Pengajuan $pengajuan){
        Pengajuan::where('id', $pengajuan->id)->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/pengajuan/admin')->with("success", "Pengajuan TTE selesai!");
    }

    public function tolak(Pengajuan $Pengajuan){
        Pengajuan::where('id', $Pengajuan->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/Pengajuan/admin')->with("success", "Agenda kunjungan ditolak!");
    }

    public function selesaiSemua(){
        Pengajuan::where('status', 'diproses')->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/pengajuan/admin')->with("success", "Pengajuan TTE selesai diproses!");
    }
}
