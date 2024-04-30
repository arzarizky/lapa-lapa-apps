<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komoditas extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['deletesubkomoditas', 'deleterekapharga'];

    protected $table = 'komoditas';

    // protected $fillable = [
    //     'pasar_id',
    //     'kota_id',
    //     'nama',
    //     'dk',
    //     'dp',
    //     'harga',
    // ];

    public function deletesubkomoditas()
    {
        return $this->hasMany(Subkomoditas::class, 'komoditas_id', 'id');
    }
    public function deleterekapharga()
    {
        return $this->hasMany(Rekapharga::class, 'komoditas_id', 'id');
    }

    public function subkomoditas()
    {
        return $this->hasMany(Subkomoditas::class, 'komoditas_id', 'id');
    }

    public function jenispasar()
    {
        return $this->hasOne(Jenispasar::class, 'id', 'pasar_id');
    }

    public function rekapharga()
    {
        return $this->hasMany(Rekapharga::class, 'komoditas_id', 'id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
