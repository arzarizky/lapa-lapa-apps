<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subkomoditas extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['deleterekapharga'];

    protected $table = 'subkomoditas';

    // protected $fillable = [
    //     'komoditas_id',
    //     'nama',
    //     'dk',
    //     'dp',
    //     'user_id',
    //     'tanggal',
    // ];

    public function deleterekapharga()
    {
        return $this->hasMany(Rekapharga::class, 'subkomoditas_id', 'id');
    }

    public function rekapharga()
    {
        return $this->hasMany(Rekapharga::class, 'subkomoditas_id', 'id');
    }
}
