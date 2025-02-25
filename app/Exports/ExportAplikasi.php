<?php

namespace App\Exports;

use App\Models\Aplikasi;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAplikasi implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aplikasi::select('aplikasis.nip','aplikasis.nama_pic','aplikasis.jabatan','aplikasis.opd',
        'aplikasis.email','aplikasis.no_telp','aplikasis.nama_app','aplikasis.deskripsi','aplikasis.tipe',
        'aplikasis.tahun_pembuatan','aplikasis.bahasa_pemograman','aplikasis.framework','aplikasis.database',
        'aplikasis.sistem_operasi','aplikasis.instalasi','aplikasis.status')
        ->get();
}

public function headings(): array
{
    return [
        'No',
        'NIP Pengaju',
        'Nama PIC',
        'Jabatan',
        'OPD',
        'Email',
        'No Telepon',
        'Nama Aplikasi',
        'Deskripsi Aplikasi',
        'Tipe Aplikasi',
        'Tahun Pembuatan Aplikasi',
        'Bahasa Pemograman Aplikasi',
        'Framework Aplikasi',
        'Database Aplikasi',
        'Sistem Operasi Aplikasi',
        'Instalasi Aplikasi',
        'Status'
    ];
}

public function map($aplikasi): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $aplikasi->nip,
        $aplikasi->nama_pic,
        $aplikasi->jabatan,
        $aplikasi->opd,
        $aplikasi->email,
        $aplikasi->no_telp,
        $aplikasi->nama_app,
        $aplikasi->deskripsi,
        $aplikasi->tipe,
        $aplikasi->tahun_pembuatan,
        $aplikasi->bahasa_pemograman,
        $aplikasi->framework,
        $aplikasi->database,
        $aplikasi->sistem_operasi,
        $aplikasi->instalasi,
        $aplikasi->status
    ];
}
}
