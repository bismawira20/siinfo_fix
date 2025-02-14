<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Passphrase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nip_pemohon',
        'no_telp',
        'nama_user',
        'nik_user',
        'nip_user',
        'email_domain',
        'tanggapan',
        'alasan',
        'status'];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}