<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'm_dokumen_pevita';
    protected $fillable = [
        'file_name',
        'partner_name',
        'jenis_dokumen',
        'sign_by',
        'status',
        'pic_before',
        'pic_after',
        'item_desc',
        'item_desc1',
        'received',
        'create_dtm',
        'path_before',
        'path_after',
        'size_file'
    ];

    public function penagihan()
    {
        return $this->belongsToMany(Penagihan::class);
    }
}
