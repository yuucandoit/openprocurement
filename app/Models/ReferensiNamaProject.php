<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiNamaProject extends Model
{
    use HasFactory;
    protected $table = 'referensi_nama_project';
    protected $fillable = [
        'name'
    ];

    public function pengajuanpembelian()
    {
        return $this->hasMany(CategoryPengajuanPembelian::class, 'purpose');
    }
}
