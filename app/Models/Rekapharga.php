<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekapharga extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'rekaphargas';

    protected $fillable = [
        'pemilik_id',
        'harga',
        'dk',
        'dp',
        'useredit_id',
        'tanggal',
    ];

    // public function subkomoditas()
    // {
    //     return $this->belongsTo(Subkomoditas::class, 'subkomoditas_id', 'id');
    // }
    // public function komoditas()
    // {
    //     return $this->belongsTo(Komoditas::class, 'komoditas_id', 'id');
    // }
    // public function kota()
    // {
    //     return $this->belongsTo(Kota::class, 'kota_id', 'id');
    // }
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'useredit_id', 'id');
    }
}
