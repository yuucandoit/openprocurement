<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

class PengajuanDana extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_dana';
    protected $fillable = [
        'pd_id',
        'item',
        'qty',
        'harga',
        'status',
        'total',
        'created_at',
        'updated_at',
    ];
}
