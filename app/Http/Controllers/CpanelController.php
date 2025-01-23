<?php

namespace App\Http\Controllers;

use App\Models\Cpanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CpanelController extends Controller
{
    public function index(){
        // return 'uji';
        $cpanel = Cpanel::where('user_id', Auth::id())
                         ->paginate(10);
        return view('dashboard.cpanel.index', compact('cpanel'));
    }

    public function create(){
        return view('dashboard.cpanel.create',[
        
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|max:15',
            'nip' => 'required',
            'jabatan' => 'required|max:255',
            'asal_opd' => 'required|max:255',
            'url' =>'required|max:255',
            'file' => 'nullable|file|mimes:pdf|max:1024',
        ]);

        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('cpanel-file');
        }

        $validatedData['user_id'] = Auth::id();
        Cpanel::create($validatedData);

        return redirect ('/dashboard/cpanel/')->with("success", "Pengajuan CPANEL berhasil ditambahkan!");
    }

    public function edit(Cpanel $cpanel){
        return view('dashboard.cpanel.edit',[
            'cpanel' => $cpanel,
        ]);
    }

    public function update(Request $request, Cpanel $cpanel){
        $validatedData = $request->validate([
           'nama' => 'required|max:255',
            'no_telp' => 'required|max:15',
            'nip' => 'required',
            'jabatan' => 'required|max:255',
            'asal_opd' => 'required|max:255',
            'url' =>'required|max:255',
            'file' => 'nullable|file|mimes:pdf|max:1024',
        ]);
    
        if ($request->file('file')) {
            if ($cpanel->file) {
                Storage::disk('public')->delete($cpanel->file);
            }
    
            $validatedData['file'] = $request->file('file')->store('cpanel-file', 'public');
        }
    
        $validatedData['user_id'] = Auth::id(); 
        $cpanel->update($validatedData);
    
        return redirect('/dashboard/cpanel/')->with("success", "Pengajuan CPANEL berhasil diperbarui!");
    }

    public function destroy(Cpanel $cpanel){
            if($cpanel->file){
                Storage::delete($cpanel->file);
            }
            Cpanel::destroy($cpanel->id);
            return redirect('/dashboard/cpanel/')->with("success", "Pengajuan CPANEL berhasil dihapus!");
    }

    public function adminIndex(){
        $cpanel = Cpanel::paginate(10);
        return view('dashboard.cpanel.admin.index', compact('cpanel'));
    }

    public function selesai(Cpanel $cpanel){
        Cpanel::where('id', $cpanel->id)->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/cpanel/admin')->with("success", "Pengajuan CPANEL selesai!");
    }

    public function selesaiSemua(){
        Cpanel::where('status', 'diproses')->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/cpanel/admin')->with("success", "Pengajuan CPANEL selesai!");
    }
}
