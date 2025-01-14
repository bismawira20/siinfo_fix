<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class AdminBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.bidangs.index',[
            'bidangs' => Bidang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.bidangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        Bidang::create($validatedData);

        return redirect('/dashboard/bidangs')->with("success", "Bidang kerja berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        return view('dashboard.bidangs.edit',[
            'bidang' => $bidang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidang $bidang)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        Bidang::where('id', $bidang->id)->update($validatedData);

        return redirect('/dashboard/bidangs')->with("success", "Bidang kerja berhasil diupdate!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidang $bidang)
    {
        Bidang::destroy($bidang->id);

        return redirect('/dashboard/bidangs')->with("success", "Bidang kerja berhasil dihapus!");
    }
}
