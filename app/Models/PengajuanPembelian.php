<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembelian extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_pembelian';
    protected $fillable = [
        'pp_id',
        'item',
        'qty',
        'unit_price',
        'total',
        'all_cost',
        'created_at',
        'updated_at',
    ];
}
