<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPT extends Model
{
    use HasFactory;

    protected $table = "category_pt";
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp_kantor',
        'website',
        'nama_pic',
        'no_telp_pic',
        'email',
        'npwp_perusahaan',
        'pkp',
        'nib',
        'bidang_usaha',
        'no_rekening',
        'bank',
        'cabang_bank',
        'nama_penerima'
    ];

    public function pengajuanpembelian()
    {
        return $this->hasMany(PengajuanPembelian::class);
    }

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendortable');
    }
}
