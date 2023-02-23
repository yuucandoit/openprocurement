<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    use HasFactory;
    protected $table = 'item_history';
    protected $fillable = [
        'id',
        'item',
        'qty',
        'unit_price',
        'total',
        'discount',
        'dpp',
        'ongkir',
        'admin_fee',
        'matauang',
        'ppn',
        'grand_total',
    ];
}
