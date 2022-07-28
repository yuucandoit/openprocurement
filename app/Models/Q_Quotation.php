<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Q_Quotation extends Model
{

    protected $table = 'quotation';
    protected $fillable = [
        'id',
        'category_id',
        'type',
        'qty',
        'unit',
        'unitprice',
        'amount',
        "created_at",
        "updated_at"
    ];

    protected $hidden;
}
