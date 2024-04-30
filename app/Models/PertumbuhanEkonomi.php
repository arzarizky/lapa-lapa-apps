<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertumbuhanEkonomi extends Model
{
    use HasFactory;

    protected $table = 'pertumbuhan_ekonomis';

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
