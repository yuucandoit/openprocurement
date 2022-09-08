<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTL extends Model
{
    use HasFactory;
    protected $table = 'categorytl';
    protected $fillable = [
        'id',
        'ppb_id',
        'user_id',
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }
    public function tujuan()
    {
        return $this->belongsTo(ReferensiNamaProject::class);
    }
}
