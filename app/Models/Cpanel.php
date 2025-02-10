<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_telp',
        'nip',
        'jabatan',
        'asal_opd',
        'url',
        'file',
        'tanggapan',
        'status'];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
