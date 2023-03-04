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
        'item_ppid',
        'term_conditions',
        'vendorable_type',
        'vendorable_id',
        'atasan_po',
        'quotation',
        'signature',
        'status',
        'path_quotation',
        'path_invoice',
        'matauang',
        'code_po',
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
        return $this->belongsTo(PengajuanPembelian::class, 'item_ppid');
    }
    public function term()
    {
        return $this->belongsTo(TermsAndConditions::class, 'term_conditions');
    }
    public function itempo()
    {
        return $this->hasMany(ItemPO::class, 'po_id');
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
