<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kritikdansaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kritikdansarans';

    protected $fillable = [
        'kota_id',
        'nama',
        'kritik',
        'saran',
        'status',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
