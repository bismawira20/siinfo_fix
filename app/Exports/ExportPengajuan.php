<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPengajuan implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengajuan::select('pengajuans.nama','pengajuans.nip','pengajuans.nik','pengajuans.nama_opd',
        'pengajuans.no_telp','pengajuans.email_domain','pengajuans.jabatan','pengajuans.status')
        ->get();
    }
    public function headings(): array
{
    return [
        'No',
        'Nama Pengaju',
        'NIP Pengaju',
        'NIK Pengaju',
        'OPD',
        'No Telepon Pengaju',
        'Email Domain',
        'Jabatan',
        'Status'
    ];
}
public function map($pengajuan): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $pengajuan->nama,
        $pengajuan->nip,
        $pengajuan->nik,
        $pengajuan->nama_opd,
        $pengajuan->no_telp,
        $pengajuan->email_domain,
        $pengajuan->jabatan,
        $pengajuan->status,
    ];
}
}
