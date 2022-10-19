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
        'ppb_id',
        'vendorable_id',
        'vendorable_type',
        'term_conditions',
        'atasan_po',
        'address',
        'no_telp',
        'no_npwp',
        'quotation',
        'created_at',
        'updated_at'
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }
    public function term()
    {
        return $this->belongsTo(TermsAndConditions::class, 'term_conditions');
    }
    public function atasans()
    {
        return $this->belongsTo(User::class, 'atasan_po');
    }
    public function vendorable()
    {
        return $this->morphTo();
    }
}
