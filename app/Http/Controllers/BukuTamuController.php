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
                         ->paginate(10);
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
