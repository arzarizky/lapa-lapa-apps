<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifikasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifikasis';

    protected $fillable = [
        'time',
        'title',
        'description',
        'condition',
    ];
}
