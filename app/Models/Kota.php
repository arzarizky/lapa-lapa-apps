<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = [
        'deleterekaphargas',
        'deletesubkomoditas',
        'deletekomoditas',
    ];

    protected $table = 'kotas';

    protected $fillable = [
        'nama'
    ];

    public function delete()
    {
    }
    public function deleterekaphargas()
    {
        return $this->hasMany(Rekapharga::class, 'kota_id', 'id');
    }
    public function deletesubkomoditas()
    {
        return $this->hasMany(Subkomoditas::class, 'kota_id', 'id');
    }
    public function deletekomoditas()
    {
        return $this->hasMany(Komoditas::class, 'kota_id', 'id');
    }
}
