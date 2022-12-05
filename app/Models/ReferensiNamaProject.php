<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiNamaProject extends Model
{
    use HasFactory;
    protected $table = 'referensi_nama_project';
    protected $fillable = [
        'id',
        'name'
    ];

    public function purposes()
    {
        return $this->morphMany(CategoryPengajuanPembelian::class, 'purpose');
    }
}
