<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inflasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inflasis';

    protected $fillable = [
        'tanggal',
        'prosentase',
        'useradd_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'useradd_id', 'id');
    }
}
