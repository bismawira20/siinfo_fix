<?php

namespace App\Http\Controllers;

use App\Models\EmailDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmailDinasController extends Controller
{
    public function index(){
        // return 'uji';
        $emaildinas = EmailDinas::where('user_id', Auth::id())
                         ->paginate(10);
        return view('dashboard.emaildinas.index', compact('emaildinas'));
    }

    public function create(){
        return view('dashboard.emaildinas.create',[
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama_opd' => 'required|max:255',
            'nama_pic' => 'required|max:255',
            'no_telp_pic' => 'required|max:15',
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:1024',
            'form_pengajuan' => 'required|file|mimes:pdf|max:1024',
            'nama_pemohon' => 'required|max:255',
            'nip_pemohon' => 'required|max:255',
            'no_telp_pemohon' => 'required|max:255',
            'nama_2' => 'nullable|max:255',
            'nip_2' => 'nullable|max:255',
            'no_telp_2' => 'nullable|max:255',
            'nama_3' => 'nullable|max:255',
            'nip_3' => 'nullable|max:255',
            'no_telp_3' => 'nullable|max:255',
            'nama_4' => 'nullable|max:255',
            'nip_4' => 'nullable|max:255',
            'no_telp_4' => 'nullable|max:255',
            'nama_5' => 'nullable|max:255',
            'nip_5' => 'nullable|max:255',
            'no_telp_5' => 'nullable|max:255',
        ]);

        if($request->file('surat_rekomendasi')){
            $validatedData['surat_rekomendasi'] = $request->file('surat_rekomendasi')->store('emaildinas-surat');
        }

        if($request->file('form_pengajuan')){
            $validatedData['form_pengajuan'] = $request->file('form_pengajuan')->store('emaildinas-form');
        }

        $validatedData['user_id'] = Auth::id();
        EmailDinas::create($validatedData);

        return redirect ('/dashboard/emaildinas/')->with("success", "Pengajuan Email Dinas berhasil ditambahkan!");
    }

    public function edit(EmailDinas $emaildinas){
        return view('dashboard.emaildinas.edit',[
            'emaildinas' => $emaildinas,
        ]);
    }

    public function update(Request $request, EmailDinas $emaildinas){
        $validatedData = $request->validate([
            'nama_opd' => 'required|max:255',
            'nama_pic' => 'required|max:255',
            'no_telp_pic' => 'required|max:15',
            'surat_rekomendasi' => 'nullable|file|mimes:pdf|max:1024',
            'form_pengajuan' => 'nullable|file|mimes:pdf|max:1024',
            'nama_pemohon' => 'required|max:255',
            'nip_pemohon' => 'required|max:255',
            'no_telp_pemohon' => 'required|max:255',
            'nama_2' => 'nullable|max:255',
            'nip_2' => 'nullable|max:255',
            'no_telp_2' => 'nullable|max:255',
            'nama_3' => 'nullable|max:255',
            'nip_3' => 'nullable|max:255',
            'no_telp_3' => 'nullable|max:255',
            'nama_4' => 'nullable|max:255',
            'nip_4' => 'nullable|max:255',
            'no_telp_4' => 'nullable|max:255',
            'nama_5' => 'nullable|max:255',
            'nip_5' => 'nullable|max:255',
            'no_telp_5' => 'nullable|max:255',
        ]);
    
        if ($request->file('surat_rekomendasi')) {
            if ($emaildinas->surat_rekomendasi) {
                Storage::disk('public')->delete($emaildinas->surat_rekomendasi);
            }
        
            $validatedData['surat_rekomendasi'] = $request->file('surat_rekomendasi')->store('emaildinas-surat', 'public');
        }

        if ($request->file('form_pengajuan')) {
            if ($emaildinas->form_pengajuan) {
                Storage::disk('public')->delete($emaildinas->form_pengajuan);
            }
        
            $validatedData['form_pengajuan'] = $request->file('form_pengajuan')->store('emaildinas-form', 'public');
        }
    
        $validatedData['user_id'] = Auth::id(); 
        $emaildinas->update($validatedData);
    
        return redirect('/dashboard/emaildinas/')->with("success", "Pengajuan Email Dinas berhasil diperbarui!");
    }

    public function destroy(EmailDinas $emaildinas){
        if($emaildinas->surat_rekomendasi){
            Storage::delete($emaildinas->surat_rekomendasi);
        }
        if($emaildinas->form_pengajuan){
            Storage::delete($emaildinas->form_pengajuan);
        }
        EmailDinas::destroy($emaildinas->id);
        return redirect('/dashboard/emaildinas/')->with("success", "Pengajuan Email Dinas berhasil dihapus!");
    }

    public function adminIndex(){
        $emaildinas = EmailDinas::paginate(10);
        return view('dashboard.emaildinas.admin.index', compact('emaildinas'));
    }

    public function selesai(EmailDinas $emaildinas){
        EmailDinas::where('id', $emaildinas->id)->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/emaildinas/admin')->with("success", "Pengajuan Email Dinas selesai!");
    }

    public function selesaiSemua(){
        EmailDinas::where('status', 'diproses')->update([
            'status' => 'selesai'
        ]);

        return redirect('/dashboard/emaildinas/admin')->with("success", "Pengajuan Email Dinas selesai!");
    }
}
