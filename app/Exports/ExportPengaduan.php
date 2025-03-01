<?php

namespace App\Exports;

use App\Models\Pengaduan;
use App\Models\JenisPengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPengaduan implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
        {
            return Pengaduan::select('pengaduans.nama', 'pengaduans.no_telp', 'jenis_pengaduans.nama as jenis_pengaduan', 'pengaduans.deskripsi', 'pengaduans.created_at', 'pengaduans.status')
                ->join('jenis_pengaduans', 'pengaduans.jenis_id', '=', 'jenis_pengaduans.id')
                ->get();
        }
    
    public function headings(): array
        {
            return [
                'No',
                'Nama Pengadu',
                'No Telepon',
                'Jenis Pengaduan',
                'Deskripsi',
                'Tanggal Pengaduan',
                'Status',
            ];
        }
    
    public function map($pengaduan): array
        {
            static $rowNumber = 1; // Static variable to keep track of the row number
    
            return [
                $rowNumber++, // Increment the row number for each row
                $pengaduan->nama,
                $pengaduan->no_telp,
                $pengaduan->jenis_pengaduan,
                $pengaduan->deskripsi,
                $pengaduan->created_at,
                $pengaduan->status,
            ];
        }
    }

