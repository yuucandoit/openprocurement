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
        'ws',
        'item',
        'qty',
        'ref',
        'desc',
        'purpose',
        'priceperunit',
        'total',
        'no_rek',
        'quotation',
        'address',
        'npwp',
        'send_to',
        'date_send',
        'proposed_supplier',
        'created_at',
        'updated_at'
    ];

    public function pt()
    {
        return $this->belongsTo(CategoryPT::class);
    }

    public function po()
    {
        return $this->belongsTo(CategoryPO::class);
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

    public function datapo()
    {
        return $this->hasMany(CategoryPO::class);
    }
}
