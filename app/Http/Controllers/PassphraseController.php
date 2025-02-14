<?php

namespace App\Http\Controllers;

use App\Models\Passphrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'nama' => 'required|max:255',
            'nip_pemohon' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'no_telp' => 'required|max:15',
            'nama_user' => 'required|max:255',
            'nik_user' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'nip_user' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'email_domain' => [
                'required', 
                'email', 
                'regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/'
            ],    
            'alasan' => 'required'
        ]);

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
            'nip_pemohon' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'no_telp' => 'required|max:15',
            'nama_user' => 'required|max:255',
            'nik_user' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'nip_user' => [
                'required', 
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'email_domain' => [
                'required', 
                'email', 
                'regex:/^[a-zA-Z0-9._%+-]+@semarangkota\.go\.id$/'
            ],    
            'alasan' => 'required'
        ]);

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

        return redirect('/dashboard/passphrase/admin')->with("success", "Passphrase TTE selesai diproses!");
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
}