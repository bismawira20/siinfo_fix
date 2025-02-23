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
            'jabatan' => 'required'],[
                'nama.required' => 'Nama harus diisi.',
                'nama.max' => 'Nama tidak boleh lebih dari 20 karakter.',
                'nama.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
                
                'nip.required' => 'NIP harus diisi.',
                'nip.regex' => 'NIP hanya boleh mengandung angka.',
                'nip.digits' => 'NIP harus terdiri dari 18 digit.',
                
                'nik.required' => 'NIK harus diisi.',
                'nik.regex' => 'NIK hanya boleh mengandung angka.',
                'nik.digits' => 'NIK harus terdiri dari 16 digit.',
                
                'nama_opd.required' => 'Nama OPD harus diisi.',
                'nama_opd.max' => 'Nama OPD tidak boleh lebih dari 255 karakter.',
                
                'no_telp.required' => 'Nomor telepon harus diisi.',
                'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
                'no_telp.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit.',
                
                'email_domain.required' => 'Email harus diisi.',
                'email_domain.email' => 'Format email tidak valid.',
                'email_domain.regex' => 'Email harus menggunakan domain semarangkota.go.id.',
                
                'jabatan.required' => 'Jabatan harus diisi.'
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
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/pengajuan/admin')->with("success", "Pengajuan TTE disetujui!");
    }

    public function tolak(Pengajuan $Pengajuan){
        Pengajuan::where('id', $Pengajuan->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/pengajuan/admin')->with("success", "Pengajuan TTE ditolak!");
    }

    public function selesaiSemua(){
        Pengajuan::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/pengajuan/admin')->with("success", "Pengajuan TTE selesai diproses!");
    }
}
