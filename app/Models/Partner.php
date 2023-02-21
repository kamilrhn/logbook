<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'm_partner';
    protected $fillable = [
        'partner_name'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_partner', 'partner_id');
    }    
}
