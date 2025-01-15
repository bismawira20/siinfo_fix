<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuTamuController extends Controller
{
    public function index(){
        // return 'uji';
        $bukutamu = BukuTamu::where('user_id', Auth::id())
                         ->with('bidang') // Tambahkan eager loading
                         ->get();
        return view('dashboard.bukutamu.index', compact('bukutamu'));
    }

    public function create(){
        return view('dashboard.bukutamu.create',[
            'bidangs' =>Bidang::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'bidang_id' => 'required',
            'no_telp' => 'required|max:15',
            'instansi' => 'required|max:255',
            'tujuan' => 'required',
            'tanggal' => 'required'
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
            'tanggal' => 'required'
        ]);

        $validatedData['user_id'] = Auth::id();
        
        BukuTamu::where('id', $bukutamu->id)->update($validatedData);

        return redirect('/dashboard/bukutamu')->with("success", "Agenda kunjungan berhasil diupdate!");
    }

    public function adminIndex(){
        $bukutamu = BukuTamu::all();
        return view('dashboard.bukutamu.admin.index', compact('bukutamu'));
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
}
