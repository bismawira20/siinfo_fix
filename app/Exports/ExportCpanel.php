<?php

namespace App\Exports;

use App\Models\Cpanel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCpanel implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cpanel::select('cpanels.nama','cpanels.no_telp','cpanels.nip','cpanels.jabatan',
        'cpanels.asal_opd','cpanels.url','cpanels.status')
        ->get();
}

public function headings(): array
{
    return [
        'No',
        'Nama Pengaju',
        'No Telepon',
        'NIP',
        'Jabatan',
        'OPD',
        'URL',
        'Status'
    ];
}

public function map($cpanel): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $cpanel->nama,
        $cpanel->no_telp,
        $cpanel->nip,
        $cpanel->jabatan,
        $cpanel->asal_opd,
        $cpanel->url,
        $cpanel->status,
    ];
}
}
