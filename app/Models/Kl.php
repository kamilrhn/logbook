<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kl extends Model
{
    use HasFactory;
    protected $table = 'm_kl';
    protected $fillable = [
        'no_kl',
        'partner_id',
        'status',
        'last_update_by',
        'kl_periode'
    ];
    protected $primaryKey = 'no_kl';
    public $incrementing = false;
}
