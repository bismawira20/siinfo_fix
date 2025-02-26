<?php

namespace App\Http\Controllers;

use App\Models\Cpanel;
use Illuminate\Http\Request;
use App\Exports\ExportCpanel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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
            'nama' => 'required|max:255|regex:/^[\p{L} ]+$/u', // Nama tidak boleh mengandung angka dan simbol
            'no_telp' => 'required|digits_between:10,15', // No telp harus diisi angka dan memiliki panjang antara 10 hingga 15 digit
            'nip' => 'required|digits:18', // NIP harus terdiri dari 18 digit
            'jabatan' => 'required|max:255',
            'asal_opd' => 'required|max:255',
            'url' => 'required|max:255|regex:/^(https?:\/\/)?[a-z0-9-]+\.semarangkota\.go\.id$/i', // Pastikan URL valid
            'file' => 'required|file|mimes:pdf|max:1024',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',
            'nip.required' => 'NIP harus diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'asal_opd.required' => 'Asal OPD harus diisi.',
            'url.required' => 'URL harus diisi.',
            'url.regex' => 'URL harus dalam format yang valid, seperti bongsari.semarangkota.go.id.',
            'file.required' => 'File harus diisi',
            'file.mimes' => 'File harus berupa dokumen PDF.',
            'file.max' => 'File tidak boleh lebih dari 1 MB.',
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

    public function adminIndex(Request $request){
        $cpanel = Cpanel::query();
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $cpanel->where('status', $request->status);
        }

        $cpanel = $cpanel->paginate(10);

        return view('dashboard.cpanel.admin.index', compact('cpanel'));
    }

    public function selesai(Cpanel $cpanel){
        Cpanel::where('id', $cpanel->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/cpanel/admin')->with("success", "Pengajuan CPANEL disetujui!");
    }

    public function selesaiSemua(){
        Cpanel::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/cpanel/admin')->with("success", "Pengajuan CPANEL disetujui!");
    }

    public function tolak(Cpanel $cpanel){
        Cpanel::where('id', $cpanel->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/cpanel/admin')->with("success", "Pengajuan CPANEL ditolak!");
    }

    public function adminShow(Cpanel $cpanel){
        return view('dashboard.cpanel.admin.show',[
            'cpanel' => $cpanel
        ]);
    }

    public function adminTanggapi(Cpanel $cpanel){
        return view('dashboard.cpanel.admin.tanggapan',[
            'cpanel' => $cpanel
        ]);
    }

    public function adminUpdate(Request $request, Cpanel $cpanel)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan bukutamu
        $cpanel->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/cpanel/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }

    public function export_excel(){
        return Excel::download(new ExportCpanel, 'pembuatan-cpanel.xlsx');
    }
}
