<?php

namespace App\Http\Controllers;

use App\Models\EmailDinas;
use Illuminate\Http\Request;
use App\Exports\ExportEmailDinas;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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
        ], [
            'nama_opd.required' => 'Nama harus diisi.',
            'nama_opd.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nama_pic.required' => 'Nama harus diisi.',
            'nama_pic.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'no_telp_pic.required' => 'Nomor telepon harus diisi.',
            'no_telp_pic.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',
            'surat_rekomendasi.required' => 'File harus diisi',
            'surat_rekomendasi.mimes' => 'File harus berupa dokumen PDF.',
            'surat_rekomendasi.max' => 'File tidak boleh lebih dari 1 MB.',
            'form_pengajuan.required' => 'File harus diisi',
            'form_pengajuan.mimes' => 'File harus berupa dokumen PDF.',
            'form_pengajuan.max' => 'File tidak boleh lebih dari 1 MB.',

            'nama_pemohon.required' => 'Nama harus diisi.',
            'nama_pemohon.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_pemohon.required' => 'NIP harus diisi.',
            'nip_pemohon.digits' => 'NIP harus terdiri dari 18 digit.',
            'no_telp_pemohon.required' => 'Nomor telepon harus diisi.',
            'no_telp_pemohon.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',

            'nama_2.required' => 'Nama harus diisi.',
            'nama_2.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_2.required' => 'NIP harus diisi.',
            'nip_2.digits' => 'NIP harus terdiri dari 18 digit.',
            'no_telp_2.required' => 'Nomor telepon harus diisi.',
            'no_telp_2.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',

            'nama_3.required' => 'Nama harus diisi.',
            'nama_3.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_3.required' => 'NIP harus diisi.',
            'nip_3.digits' => 'NIP harus terdiri dari 18 digit.',
            'no_telp_3.required' => 'Nomor telepon harus diisi.',
            'no_telp_3.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',

            'nama_4.required' => 'Nama harus diisi.',
            'nama_4.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_4.required' => 'NIP harus diisi.',
            'nip_4.digits' => 'NIP harus terdiri dari 18 digit.',
            'no_telp_4.required' => 'Nomor telepon harus diisi.',
            'no_telp_4.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',

            'nama_5.required' => 'Nama harus diisi.',
            'nama_5.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_5.required' => 'NIP harus diisi.',
            'nip_5.digits' => 'NIP harus terdiri dari 18 digit.',
            'no_telp_5.required' => 'Nomor telepon harus diisi.',
            'no_telp_5.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',
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

    public function adminIndex(Request $request) {
        $emaildinas = EmailDinas::query();
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $emaildinas->where('status', $request->status);
        }

        $emaildinas = $emaildinas->paginate(10);
        
        return view('dashboard.emaildinas.admin.index', compact('emaildinas'));
    }

    public function selesai(EmailDinas $emaildinas){
        EmailDinas::where('id', $emaildinas->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/emaildinas/admin')->with("success", "Pengajuan Email Dinas disetujui!");
    }

    public function selesaiSemua(){
        EmailDinas::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/emaildinas/admin')->with("success", "Pengajuan Email Dinas disetujui!");
    }
    public function tolak(EmailDinas $emaildinas){
        EmailDinas::where('id', $emaildinas->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/emaildinas/admin')->with("success", "Pengajuan Email Dinas ditolak!");
    }

    public function adminShow(EmailDinas $emaildinas){
        return view('dashboard.emaildinas.admin.show',[
            'emaildinas' => $emaildinas
        ]);
    }

    public function adminTanggapi(EmailDinas $emaildinas){
        return view('dashboard.emaildinas.admin.tanggapan',[
            'emaildinas' => $emaildinas
        ]);
    }

    public function adminUpdate(Request $request, EmailDinas $emaildinas)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);

        // Update tanggapan bukutamu
        $emaildinas->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/emaildinas/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }
    public function export_excel(){
        return Excel::download(new ExportEmailDinas, 'pembuatan-email-dinas.xlsx');
    }
}
