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
        'vendorable_id',
        'vendorable_type',
        'path_file',
        'item',
        'qty',
        'kategori',
        'unit_price',
        'total',
        'grand_total',
        'created_at',
        'updated_at',
    ];
    // public function vendorable()
    // {
    //     return $this->morphTo();
    // }

}
