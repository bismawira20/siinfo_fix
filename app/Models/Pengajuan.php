<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'nik',
        'nama_opd',
        'no_telp',
        'email_domain',
        'jabatan',
        'tanggapan',
        'status'];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
