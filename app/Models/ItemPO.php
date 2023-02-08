<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPO extends Model
{
    use HasFactory;
    protected $table = 'item_po';
    protected $fillable = [
        'po_id',
        'item',
        'qty',
        'kategori',
        'unit_price',
        'matauang',
        'ongkir',
        'discount',
        'total',
        'dpp',
        'grand_total',
        'ppn',
    ];

    public function po()
    {
        return $this->belongsTo(CategoryPO::class, 'po_id');
    }


}
