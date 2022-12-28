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
        'atasan',
        'matauang',
        'ws',
        'desc',
        'purpose',
        'department',
        'no_rek',
        'quotation',
        'address',
        'npwp',
        'send_to',
        'ppn',
        'dateline',
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

    public function atasans()
    {
        return $this->belongsTo(User::class, 'atasan_po');
    }

    public function atasanpymnt()
    {
        return $this->belongsTo(User::class, 'atasan_py');
    }

    public function purpose()
    {
        return $this->morphTo();
    }

    public function ws()
    {
        return $this->belongsTo(WhoSubmitted::class);
    }

    public function whosubmit()
    {
        return $this->belongsTo(WhoSubmitted::class, 'ws');
    }

    public function dps()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function bod()
    {
        return $this->belongsTo(User::class, 'atasan');
    }

}
