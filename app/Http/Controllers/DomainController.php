<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DomainController extends Controller
{
    public function index(){
        // return 'uji';
        $domain = Domain::where('userid', Auth::id())
                         ->paginate(10);
        return view('dashboard.domain.index', compact('domain'));
    }

    public function create(){
        return view('dashboard.domain.create',[
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nip' => 'required|digits:18',
            'nama_pic' => 'required|max:255|regex:/^[\p{L} ]+$/u',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/',
            'no_telp' => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'paket' => 'required',
            'nama_domain' => 'required|regex:/^[a-zA-Z0-9._%+-]+\.semarangkota\.go\.id$/',
            'fungsi_app' => 'required',
            'bahasa_pemograman' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:1024',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            
            'nama_pic.required' => 'Nama PIC harus diisi.',
            'nama_pic.max' => 'Nama PIC tidak boleh lebih dari 255 karakter.',
            'nama_pic.regex' => 'Nama PIC hanya boleh mengandung huruf dan spasi.',
            
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            
            'opd.required' => 'OPD harus diisi.',
            'opd.max' => 'OPD tidak boleh lebih dari 255 karakter.',
            
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Email harus menggunakan domain semarangkota.go.id.',
            
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit.',
            'no_telp.regex' => 'Nomor telepon hanya boleh mengandung angka.',
            
            'paket.required' => 'Paket harus dipilih.',
            
            'nama_domain.required' => 'Nama domain harus diisi.',
            'nama_domain.regex' => 'Nama domain harus dalam format nama.semarangkota.go.id.',
            
            'fungsi_app.required' => 'Fungsi aplikasi harus diisi.',
            
            'bahasa_pemograman.required' => 'Bahasa pemrograman harus diisi.',
            
            'dokumen.required' => 'Dokumen harus diunggah.',
            'dokumen.file' => 'File harus berupa file.',
            'dokumen.mimes' => 'Dokumen harus berupa file PDF.',
            'dokumen.max' => 'Dokumen tidak boleh lebih dari 1 MB.',
        ]);

        if($request->file('dokumen')){
            $validatedData['dokumen'] = $request->file('dokumen')->store('domain-dokumen');
        }

        $validatedData['userid'] = Auth::id();
        Domain::create($validatedData);

        return redirect ('/dashboard/domain/')->with("success", "Pengajuan Domain berhasil ditambahkan!");
    }

    public function edit(Domain $domain){
        return view('dashboard.domain.edit',[
            'domain' => $domain,
        ]);
    }

    public function update(Request $request, Domain $domain){
        $validatedData = $request->validate([
            'nip' => 'required|digits:18',
            'nama_pic' => 'required|max:255|regex:/^[\p{L} ]+$/u',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/',
            'no_telp' => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'paket' => 'required',
            'nama_domain' => 'required|regex:/^[a-zA-Z0-9._%+-]+\.semarangkota\.go\.id$/',
            'fungsi_app' => 'required',
            'bahasa_pemograman' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:1024',
        ]);

        // $dokumen = $request->file('dokumen')->store('domain-dokumen');
        if ($request->file('dokumen')) {
            if ($domain->dokumen) {
                Storage::disk('public')->delete($domain->dokumen);
            }
    
            $validatedData['file'] = $request->file('dokumen')->store('domain-dokumen', 'public');
        }
    
        $validatedData['userid'] = Auth::id(); 
        $domain->update($validatedData);
    
        return redirect('/dashboard/domain/')->with("success", "Pengajuan Domain berhasil diperbarui!");
    }

    // public function destroy(Domain $domain){
    //     if($domain->dokumen){
    //         Storage::delete($domain->dokumen);
    //     }
    //     Domain::destroy($domain->id);
    //     return redirect('/dashboard/domain/')->with("success", "Pengajuan Domain berhasil dihapus!");
    // }

    public function adminIndex(Request $request) {
        $domain = Domain::query();
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $domain->where('status', $request->status);
        }

        $domain = $domain->paginate(10);
        
        return view('dashboard.domain.admin.index', compact('domain'));
    }

    public function selesai(Domain $domain){
        Domain::where('id', $domain->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/domain/admin')->with("success", "Pengajuan Domain selesai!");
    }

    public function selesaiSemua(){
        Domain::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/domain/admin')->with("success", "Pengajuan Domain selesai!");
    }

    public function tolak(Domain $domain){
        Domain::where('id', $domain->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/domain/admin')->with("success", "Pengajuan Domain ditolak!");
    }

    public function adminShow(Domain $domain){
        return view('dashboard.domain.admin.show',[
            'domain' => $domain
        ]);
    }

    public function adminTanggapi(Domain $domain){
        return view('dashboard.domain.admin.tanggapan',[
            'domain' => $domain
        ]);
    }

    public function adminUpdate(Request $request, Domain $domain)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan
        $domain->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/domain/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }
}
