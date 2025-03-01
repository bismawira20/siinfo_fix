<?php

namespace App\Exports;

use App\Models\EmailDinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportEmailDinas implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmailDinas::select('email_dinas.nama_opd','email_dinas.nama_pic','email_dinas.no_telp_pic',
        'email_dinas.nama_pemohon','email_dinas.nip_pemohon','email_dinas.no_telp_pemohon',
        'email_dinas.nama_2','email_dinas.nip_2','email_dinas.no_telp_2',
        'email_dinas.nama_3','email_dinas.nip_3','email_dinas.no_telp_3',
        'email_dinas.nama_4','email_dinas.nip_4','email_dinas.no_telp_4',
        'email_dinas.nama_5','email_dinas.nip_5','email_dinas.no_telp_5','email_dinas.status')
        ->get();
    }

    public function headings(): array
{
    return [
        'No',
        'OPD',
        'Nama PIC',
        'No Telepon PIC',
        'Nama Pemohon 1',
        'NIP Pemohon 1',
        'No Telepon Pemohon 1',
        'Nama Pemohon 2',
        'NIP Pemohon 2',
        'No Telepon Pemohon 2',
        'Nama Pemohon 3',
        'NIP Pemohon 3',
        'No Telepon Pemohon 3',
        'Nama Pemohon 4',
        'NIP Pemohon 4',
        'No Telepon Pemohon 4',
        'Nama Pemohon 5',
        'NIP Pemohon 5',
        'No Telepon Pemohon 5',
        'Status'
    ];
}
public function map($email_dina): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $email_dina->nama_opd,
        $email_dina->nama_pic,
        $email_dina->no_telp_pic,
        $email_dina->nama_pemohon,
        $email_dina->nip_pemohon,
        $email_dina->no_telp_pemohon,
        $email_dina->nama_2,
        $email_dina->nip_2,
        $email_dina->no_telp_2,
        $email_dina->nama_3,
        $email_dina->nip_3,
        $email_dina->no_telp_3,
        $email_dina->nama_4,
        $email_dina->nip_4,
        $email_dina->no_telp_4,
        $email_dina->nama_5,
        $email_dina->nip_5,
        $email_dina->no_telp_5,
        $email_dina->status,
    ];
}
}
