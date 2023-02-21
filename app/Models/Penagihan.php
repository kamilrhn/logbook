<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penagihan extends Model
{
    use HasFactory;
    protected $table = 't_penagihan';
    protected $fillable = [
        'NO_PENAGIHAN',
        'NO_KL',
        'PERIODE_PENAGIHAN',
        'ABODEMEN',
        'STATUS',
        'LAST_UPDATE_BY',
        'LAST_UPDATE_DTM',
        'CREATE_BY',
        'CREATE_DTM',
        'PERIODE_DESC',
        'SIGN_BY'
    ];
    protected $primaryKey = 'ID_PENAGIHAN';

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}
