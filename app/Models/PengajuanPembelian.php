<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanPembelian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pengajuan_pembelian';
    protected $fillable = [
        'id',
        'pp_id',
        'product_id',
        'prepr_id',
        'path_file',
        'item',
        'qty',
        'kategori',
        'unit_price',
        'total',
        'grand_total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class,'pp_id');
    }

    public function itemPrePR()
    {
        return $this->belongsTo(PartItem_Pre_pr::class, 'prepr_id');
    }

}
