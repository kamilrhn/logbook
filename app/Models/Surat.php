<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'm_surat';
    protected $fillable = [
        'nomor',
        'jenis',
        'sign_by',
        'status',
        'item_desc',
        'created_by'
    ];
}
