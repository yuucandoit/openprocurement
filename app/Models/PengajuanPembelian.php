<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembelian extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_pembelian';
    protected $fillable = [
        'id',
        'pp_id',
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
    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class,'pp_id');
    }

}
