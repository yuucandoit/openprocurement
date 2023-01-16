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
        'po_id',
        'term_conditions',
        'vendorable_type',
        'vendorable_id',
        'atasan_po',
        'quotation',
        'signature',
        'approved_at',
        'created_at',
        'updated_at'
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }
    public function items()
    {
        return $this->belongsTo(PengajuanPembelian::class);
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
