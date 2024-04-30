<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pemilik extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemiliks';

    protected $fillable = [
        'komoditas_id',
        'subkomoditas_id',
        'kota_id',
        'pasar_id',
    ];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'komoditas_id', 'id');
    }
    public function subkomoditas()
    {
        return $this->belongsTo(Subkomoditas::class, 'subkomoditas_id', 'id');
    }
    public function subkomoditasmany()
    {
        return $this->hasMany(Subkomoditas::class, 'id', 'subkomoditas_id');
    }
    public function jenispasar()
    {
        return $this->belongsTo(Jenispasar::class, 'pasar_id', 'id');
    }
    public function rekapharga()
    {
        //wajib dirubah sih
        return $this->hasMany(Rekapharga::class, 'pemilik_id', 'id')->skip(350)->take(1000);
    }
    public function rekaphargaone()
    {
        return $this->hasOne(Rekapharga::class, 'pemilik_id', 'id')->latestOfMany();
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
