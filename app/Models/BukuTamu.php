<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuTamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_telp',
        'user_id',
        'bidang_id',
        'instansi',
        'tujuan',
        'tanggal',
        'status'];
    protected $with = ['bidang','user'];

    public function bidang(){
        return $this->belongsTo(Bidang::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
