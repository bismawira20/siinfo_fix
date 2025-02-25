<?php

namespace App\Exports;

use App\Models\Domain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDomain implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Domain::select('domains.nip','domains.nama_pic','domains.jabatan','domains.opd',
        'domains.email','domains.no_telp','domains.paket','domains.nama_domain',
        'domains.fungsi_app','domains.bahasa_pemograman','domains.status')
        ->get();
}

public function headings(): array
{
    return [
        'No',
        'NIP',
        'Nama PIC',
        'Jabatan',
        'OPD',
        'Email',
        'No Telepon',
        'Pilihan Paket',
        'Nama Domain',
        'Fungsi Aplikasi',
        'Bahasa Pemograman',
        'Status'
    ];
}

public function map($domain): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $domain->nip,
        $domain->nama_pic,
        $domain->jabatan,
        $domain->opd,
        $domain->email,
        $domain->no_telp,
        $domain->paket,
        $domain->nama_domain,
        $domain->fungsi_app,
        $domain->bahasa_pemograman,
        $domain->status,
    ];
}
}