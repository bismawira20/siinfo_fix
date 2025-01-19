<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['jenispengaduan','user'];

    public function jenispengaduan(){
        return $this->belongsTo(JenisPengaduan::class, 'jenis_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
