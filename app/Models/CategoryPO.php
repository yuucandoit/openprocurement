<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPO extends Model
{
    use HasFactory;
    protected $table = 'category_po';
    protected $fillable = [
        'id',
        'user_id',
        'ppb_id',
        'name',
        'address',
        'status',
        'created_at',
        'updated_at'
    ];
    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }
}
