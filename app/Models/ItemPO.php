<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPO extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'item_po';
    protected $fillable = [
        'ppb_id',
        'po_id',
        'item',
        'qty',
        'kategori',
        'unit_price',
        'matauang',
        'ongkir',
        'admin_fee',
        'discount',
        'total',
        'dpp',
        'grand_total',
        'ppn',
        'deleted_at',
    ];

    public function po()
    {
        return $this->belongsTo(CategoryPO::class, 'po_id');
    }


}
