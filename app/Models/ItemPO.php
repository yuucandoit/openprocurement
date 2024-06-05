<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ItemPO extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'item_po';
    protected $fillable = [
        'ppb_id',
        'product_id',
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

    protected static $logFillable = true;
    protected static $logName = 'Item PO';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['id'
        ,'ppb_id',
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
        'deleted_at']);
    }

}
