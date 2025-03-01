<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\BukuTamu;
use App\Models\Bidang;

class ExportBukuTamu implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BukuTamu::select('buku_tamus.nama', 'bidangs.name as nama_bidang', 'buku_tamus.no_telp', 'buku_tamus.instansi', 'buku_tamus.tujuan', 'buku_tamus.waktu', 'buku_tamus.status')
            ->join('bidangs', 'buku_tamus.bidang_id', '=', 'bidangs.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Nama Bidang',
            'No Telepon',
            'Instansi',
            'Tujuan',
            'Waktu',
            'Status',
        ];
    }

    public function map($bukuTamu): array
    {
        static $rowNumber = 1; // Static variable to keep track of the row number

        return [
            $rowNumber++, // Increment the row number for each row
            $bukuTamu->nama,
            $bukuTamu->nama_bidang,
            $bukuTamu->no_telp,
            $bukuTamu->instansi,
            $bukuTamu->tujuan,
            $bukuTamu->waktu,
            $bukuTamu->status,
        ];
    }
}
