<?php

namespace App\Exports;

use App\Models\Passphrase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPassphrase implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Passphrase::select('passphrases.nama','passphrases.nip_pemohon','passphrases.no_telp',
        'passphrases.nama_user','passphrases.nik_user','passphrases.nip_user',
        'passphrases.email_domain','passphrases.alasan','passphrases.status')
        ->get();
    }

    public function headings(): array
{
    return [
        'No',
        'Nama Pemohon',
        'NIP Pemohon',
        'No Telepon Pemohon',
        'Nama User',
        'NIK User',
        'NIP User',
        'Email Domain',
        'Alasan',
        'Status'
    ];
}
public function map($passphrase): array
{
    static $rowNumber = 1; // Static variable to keep track of the row number

    return [
        $rowNumber++, // Increment the row number for each row
        $passphrase->nama,
        $passphrase->nip_pemohon,
        $passphrase->no_telp,
        $passphrase->nama_user,
        $passphrase->nik_user,
        $passphrase->nip_user,
        $passphrase->email_domain,
        $passphrase->alasan,
        $passphrase->status,
    ];
}
}
