<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
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
            'nip' => 'required',
            'nama_pic' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|max:15|regex:/^[0-9]+$/',
            'nama_app' => 'required',
            'deskripsi' => 'required',
            'tipe' => 'required',
            'tahun_pembuatan' => 'required|integer|min:2020|max:2027' . date('Y'),
            'bahasa_pemograman' => 'required',
            'framework' => 'required',
            'database' => 'required',
            'sistem_operasi' => 'required',
            'instalasi' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:1024',
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
            'nip' => 'required',
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
    
        // Filter berdasarkan tanggal awal dan akhir
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $aplikasi->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->tanggal_awal)),
                date('Y-m-d 23:59:59', strtotime($request->tanggal_akhir))
            ]);
        }
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $aplikasi->where('status', $request->status);
        }

        $aplikasi = $aplikasi->paginate(10)->withQueryString();

        return view('dashboard.aplikasi.admin.index', compact('aplikasi'));
    }

    public function selesai(Aplikasi $aplikasi){
        Aplikasi::where('id', $aplikasi->id)->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/aplikasi/admin')->with("success", "Pengajuan Aplikasi selesai!");
    }

    public function selesaiSemua(){
        Aplikasi::where('status', 'diproses')->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/aplikasi/admin')->with("success", "Pengajuan Aplikasi selesai!");
    }

    public function adminShow(Aplikasi $aplikasi){
        return view('dashboard.aplikasi.admin.show',[
            'aplikasi' => $aplikasi
        ]);
    }

}
