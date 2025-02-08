<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
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
        'tanggapan',
        'tanggal',
        'waktu',
        'status'];
        
    protected $with = ['bidang','user'];

    public function bidang(){
        return $this->belongsTo(Bidang::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query):void
    {
        $query->where('tujuan','like','%'.request('search').'%');
    }
}
