<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPengajuanPembelian extends Model
{
    use HasFactory;
    protected $table = 'category_pengajuan_pembelian';
    protected $fillable = [
        'id',
        'user_id',
        'date_ps',
        'pt_id',
        'op_id',
        'ec_id',
        'ws',
        'desc',
        'purpose',
        'item',
        'qty',
        'unit_price',
        'total',
        'no_rek',
        'quotation',
        'address',
        'npwp',
        'send_to',
        'dateline',
        'proposed_supplier',
        'created_at',
        'updated_at'
    ];

    public function pt()
    {
        return $this->belongsTo(CategoryPT::class);
    }

    public function op()
    {
        return $this->belongsTo(CategoryPP::class);
    }
    public function ec()
    {
        return $this->belongsTo(CategoryEcommerce::class);
    }
    public function ss()
    {
        return $this->belongsTo(User::class);
    }

    public function tl()
    {
        return $this->hasMany(CategoryTL::class);
    }
    public function tl_atasan()
    {
        return $this->hasMany(TaskListAtasan::class);
    }

}
