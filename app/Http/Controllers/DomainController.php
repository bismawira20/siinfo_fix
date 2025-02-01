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
            'nip' => 'required',
            'nama_pic' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|max:15|regex:/^[0-9]+$/',
            'paket' => 'required',
            'nama_domain' => 'required',
            'fungsi_app' => 'required',
            'bahasa_pemograman' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:1024',
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
            'nip' => 'required',
            'nama_pic' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'opd' => 'required|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|max:15|regex:/^[0-9]+$/',
            'paket' => 'required',
            'nama_domain' => 'required',
            'fungsi_app' => 'required',
            'bahasa_pemograman' => 'required',
            'dokumen' => 'nullable|file|mimes:pdf|max:1024',
        ]);

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

    public function destroy(Domain $domain){
        if($domain->dokumen){
            Storage::delete($domain->dokumen);
        }
        Domain::destroy($domain->id);
        return redirect('/dashboard/domain/')->with("success", "Pengajuan Domain berhasil dihapus!");
    }

    public function adminIndex(Request $request) {
        $domain = Domain::query();
    
        // Filter berdasarkan tanggal awal dan akhir
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $domain->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->tanggal_awal)),
                date('Y-m-d 23:59:59', strtotime($request->tanggal_akhir))
            ]);
        }
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $domain->where('status', $request->status);
        }

        $domain = $domain->paginate(10)->withQueryString();
        
        return view('dashboard.domain.admin.index', compact('domain'));
    }

    public function selesai(Domain $domain){
        Domain::where('id', $domain->id)->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/domain/admin')->with("success", "Pengajuan Domain selesai!");
    }

    public function selesaiSemua(){
        Domain::where('status', 'diproses')->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/domain/admin')->with("success", "Pengajuan Domain selesai!");
    }

    public function adminShow(Domain $domain){
        return view('dashboard.domain.admin.show',[
            'domain' => $domain
        ]);
    }
}
