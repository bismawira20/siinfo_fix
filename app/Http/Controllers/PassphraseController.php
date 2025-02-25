<?php

namespace App\Http\Controllers;

use App\Models\Passphrase;
use Illuminate\Http\Request;
use App\Exports\ExportPassphrase;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PassphraseController extends Controller
{
    public function index(){
        // return 'uji';
        $passphrase = Passphrase::where('user_id', Auth::id())
                         ->paginate(10);
        return view('dashboard.passphrase.index', compact('passphrase'));
    }

    public function create(){
        return view('dashboard.passphrase.create',[
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|max:255|regex:/^[\p{L} ]+$/u', // Nama tidak boleh mengandung angka dan simbol
            'nip_pemohon' => 'required|digits:18', // NIP harus terdiri dari 18 digit
            'no_telp' => 'required|digits_between:10,15', // No telp harus diisi angka dan memiliki panjang antara 10 hingga 15 digit
            'nama_user' => 'required|max:255',
            'nik_user' => 'required|digits:16',
            'nip_user' => 'required|digits:18',
            'email_domain' => 'required|email |regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/',
            'alasan' => 'required'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.digits_between' => 'Nomor telepon harus terdiri dari antara 10 hingga 15 digit.',
            'nip.required' => 'NIP harus diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            'nik.required' => 'NIK harus diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'email_domain.required' => 'Email harus diisi.',
            'email_domain.digits' => 'Email harus @semarangkota.go.id.',
            'alasan.required' => 'Alasan harus diisi',
            'alasan.digits' =>'Alasan harus diisi huruf',
            'nama_user.required' => 'Nama harus diisi.',
            'nama_user.regex' => 'Nama tidak boleh mengandung angka atau simbol.',
            'nip_user.required' => 'NIP harus diisi.',
            'nip_user.digits' => 'NIP harus terdiri dari 18 digit.',
            'nik_user.required' => 'NIK harus diisi.',
            'nik_user.digits' => 'NIK harus terdiri dari 16 digit.',
            'nip_pemohon.required' => 'NIP harus diisi.',
            'nip_pemohon.digits' => 'NIP harus terdiri dari 18 digit.',
        ]);

        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('passphrase-file');
        }

        $validatedData['user_id'] = Auth::id();
        Passphrase::create($validatedData);

        return redirect ('/dashboard/passphrase')->with("success", "Passphrase TTE berhasil ditambahkan!");
    }

    public function destroy(Passphrase $passphrase){
        Passphrase::destroy($passphrase->id);

        return redirect ('/dashboard/passphrase')->with("success", "Passphrase TTE berhasil dihapus!");

    }

    public function edit(Passphrase $passphrase){
        return view('dashboard.passphrase.edit',[
            'passphrase' => $passphrase,
        ]);
    }

    public function update(Request $request, Passphrase $passphrase)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nip' => 'required|digits:18',
            'no_telp' => 'required|max:15',
            'nama_user' => 'required|max:255',
            'nik_user' => 'required|digits:16',
            'nip_user' => 'required|digits:18',
            'email_domain' => 
                'required', 
                'email', 
                'regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/'
            ,    
            'alasan' => 'required'
        ]);

        if ($request->file('file')) {
            if ($passphrase->file) {
                Storage::disk('public')->delete($passphrase->file);
            }
    
            $validatedData['file'] = $request->file('file')->store('passphrase-file', 'public');
        }
    
        $validatedData['user_id'] = Auth::id();
        
        Passphrase::where('id', $passphrase->id)->update($validatedData);

        return redirect('/dashboard/passphrase')->with("success", "Passphrase TTE berhasil diupdate!");
    }

    // Admin
    public function adminIndex(Request $request) {
        $passphrase = Passphrase::query();
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $passphrase->where('status', $request->status);
        }

        $passphrase = $passphrase->paginate(10);

        return view('dashboard.passphrase.admin.index', compact('passphrase'));
    }
    

    public function selesai(Passphrase $passphrase){
        Passphrase::where('id', $passphrase->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/passphrase/admin')->with("success", "Passphrase TTE disetujui!");
    }

    // public function tolak(Passphrase $Passphrase){
    //     Passphrase::where('id', $Passphrase->id)->update([
    //         'status' => 'ditolak'
    //     ]);

    //     return redirect('/dashboard/Passphrase/admin')->with("success", "Agenda kunjungan ditolak!");
    // }

    public function selesaiSemua(){
        Passphrase::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/passphrase/admin')->with("success", "Passphrase TTE disetujui!");
    }

    public function tolak(passphrase $passphrase){
        passphrase::where('id', $passphrase->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/passphrase/admin')->with("success", "Pengajuan passphrase ditolak!");
    }

    public function adminShow(passphrase $passphrase){
        return view('dashboard.passphrase.admin.show',[
            'passphrase' => $passphrase
        ]);
    }

    public function adminTanggapi(passphrase $passphrase){
        return view('dashboard.passphrase.admin.tanggapan',[
            'passphrase' => $passphrase
        ]);
    }

    public function adminUpdate(Request $request, passphrase $passphrase)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);

        // Update tanggapan bukutamu
        $passphrase->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);

        // Redirect dengan pesan sukses
        return redirect('/dashboard/passphrase/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }
    public function export_excel(){
        return Excel::download(new ExportPassphrase, 'pembuatan-passphrase.xlsx');
    }
}