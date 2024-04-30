<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenispasar extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['deletekomoditas'];

    protected $table = 'jenispasars';

    protected $fillable = [
        'nama',
    ];

    public function deletekomoditas()
    {
        return $this->hasMany(Komoditas::class, 'pasar_id', 'id');
    }
}
