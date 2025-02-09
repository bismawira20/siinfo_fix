<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    public function index(){
        // return 'uji';
        $aplikasi = Aplikasi::where('userid', Auth::id())
                         ->paginate(10);
        return view('dashboard.aplikasi.index', compact('aplikasi'));
    }

    public function create(){
        return view('dashboard.aplikasi.create',[
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nip' => [
                'required',
                'digits:18', // Memastikan NIP terdiri dari 18 digit
                'regex:/^[0-9]+$/', // Memastikan NIP hanya terdiri dari angka
            ],
            'nama_pic' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|max:15|regex:/^[0-9]+$/',
            'nama_app' => 'required',
            'deskripsi' => 'required',
            'tipe' => 'required',
            'tahun_pembuatan' => 'required|integer|min:2020|max:' . date('Y'),
            'bahasa_pemograman' => 'required',
            'framework' => 'required',
            'database' => 'required',
            'sistem_operasi' => 'required',
            'instalasi' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:1024',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            'nip.regex' => 'NIP hanya boleh terdiri dari angka.',
            'nama_pic.required' => 'Nama PIC harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'opd.required' => 'OPD harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.regex' => 'Nomor telepon hanya boleh terdiri dari angka.',
            'nama_app.required' => 'Nama aplikasi harus diisi.',
            'deskripsi.required' => 'Deskripsi aplikasi harus diisi',
            'tipe.required' => 'Tipe aplikasi harus dipilih.',
            'bahasa_pemograman.required' => 'Bahasa pemograman harus diisi.',
            'framework.required' => 'Framework harus diisi.',
            'database.required' => 'Database harus diisi.',
            'sistem_operasi.required' => 'Sistem operasi harus diisi.',
            'instalasi.required' => 'Server instalasi harus dipilih.',
            'tahun_pembuatan.required' => 'Tahun pembuatan harus diisi.',
            'tahun_pembuatan.integer' => 'Tahun pembuatan harus berupa angka.',
            'tahun_pembuatan.min' => 'Tahun pembuatan tidak boleh kurang dari 2020.',
            'tahun_pembuatan.max' => 'Tahun pembuatan tidak boleh lebih dari tahun ini.',
            'dokumen.required' => 'Dokumen harus diisi',
            'dokumen.mimes' => 'Dokumen harus berupa file PDF.',
            'dokumen.max' => 'Dokumen tidak boleh lebih dari 1 MB.',
        ]);

        if($request->file('dokumen')){
            $validatedData['dokumen'] = $request->file('dokumen')->store('applikasi-dokumen');
        }

        $validatedData['userid'] = Auth::id();
        Aplikasi::create($validatedData);

        return redirect ('/dashboard/aplikasi/')->with("success", "Pengajuan Aplikasi berhasil ditambahkan!");
    }

    public function edit(Aplikasi $aplikasi){
        return view('dashboard.aplikasi.edit',[
            'aplikasi' => $aplikasi,
        ]);
    }

    public function update(Request $request, Aplikasi $aplikasi){
        $validatedData = $request->validate([
            'nip' => [
                'required',
                'digits:18', // Memastikan NIP terdiri dari 18 digit
                'regex:/^[0-9]+$/', // Memastikan NIP hanya terdiri dari angka
            ],
            'nama_pic' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|max:15|regex:/^[0-9]+$/',
            'nama_app' => 'required',
            'deskripsi' => 'required',
            'tipe' => 'required',
            'tahun_pembuatan' => 'required|integer|min:2020|max:' . date('Y'),
            'bahasa_pemograman' => 'required',
            'framework' => 'required',
            'database' => 'required',
            'sistem_operasi' => 'required',
            'instalasi' => 'required',
            'dokumen' => 'nullable|file|mimes:pdf|max:1024',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            'nip.regex' => 'NIP hanya boleh terdiri dari angka.',
            'nama_pic.required' => 'Nama PIC harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'opd.required' => 'OPD harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.regex' => 'Nomor telepon hanya boleh terdiri dari angka.',
            'nama_app.required' => 'Nama aplikasi harus diisi.',
            'deskripsi.required' => 'Deskripsi aplikasi harus diisi',
            'tipe.required' => 'Tipe aplikasi harus dipilih.',
            'bahasa_pemograman.required' => 'Bahasa pemograman harus diisi.',
            'framework.required' => 'Framework harus diisi.',
            'database.required' => 'Database harus diisi.',
            'sistem_operasi.required' => 'Sistem operasi harus diisi.',
            'instalasi.required' => 'Server instalasi harus dipilih.',
            'tahun_pembuatan.required' => 'Tahun pembuatan harus diisi.',
            'tahun_pembuatan.integer' => 'Tahun pembuatan harus berupa angka.',
            'tahun_pembuatan.min' => 'Tahun pembuatan tidak boleh kurang dari 2020.',
            'tahun_pembuatan.max' => 'Tahun pembuatan tidak boleh lebih dari tahun ini.',
            'dokumen.mimes' => 'Dokumen harus berupa file PDF.',
            'dokumen.max' => 'Dokumen tidak boleh lebih dari 1 MB.',
        ]);

        if ($request->file('dokumen')) {
            if ($aplikasi->dokumen) {
                Storage::disk('public')->delete($aplikasi->dokumen);
            }
    
            $validatedData['file'] = $request->file('dokumen')->store('applikasi-dokumen', 'public');
        }
    
        $validatedData['userid'] = Auth::id(); 
        $aplikasi->update($validatedData);
    
        return redirect('/dashboard/aplikasi/')->with("success", "Pengajuan Aplikasi berhasil diperbarui!");
    }

    public function destroy(Aplikasi $aplikasi){
        if($aplikasi->dokumen){
            Storage::delete($aplikasi->dokumen);
        }
        Aplikasi::destroy($aplikasi->id);
        return redirect('/dashboard/aplikasi/')->with("success", "Pengajuan Aplikasi berhasil dihapus!");
    }

    public function adminIndex(Request $request) {
        $aplikasi = Aplikasi::query();
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $aplikasi->where('status', $request->status);
        }

        $aplikasi = $aplikasi->paginate(10);

        return view('dashboard.aplikasi.admin.index', compact('aplikasi'));
    }

    public function selesai(Aplikasi $aplikasi){
        Aplikasi::where('id', $aplikasi->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/aplikasi/admin')->with("success", "Pengajuan Aplikasi disetujui!");
    }

    public function tolak(Aplikasi $aplikasi){
        Aplikasi::where('id', $aplikasi->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/aplikasi/admin')->with("success", "Pengajuan Aplikasi ditolak!");
    }

    public function selesaiSemua(){
        Aplikasi::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/aplikasi/admin')->with("success", "Pengajuan Aplikasi disetujui!");
    }

    public function adminShow(Aplikasi $aplikasi){
        return view('dashboard.aplikasi.admin.show',[
            'aplikasi' => $aplikasi
        ]);
    }

    public function adminTanggapi(Aplikasi $aplikasi){
        return view('dashboard.aplikasi.admin.tanggapan',[
            'aplikasi' => $aplikasi
        ]);
    }

    public function adminUpdate(Request $request, Aplikasi $aplikasi)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan bukutamu
        $aplikasi->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/aplikasi/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }
}

