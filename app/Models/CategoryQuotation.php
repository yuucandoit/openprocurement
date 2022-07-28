<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuotation extends Model
{
    use HasFactory;
    protected $table = 'category_quotation';
    protected $fillable = [
        'id',
        'user_id',
        'company_name',
        'address',
        'status',
        'created_at',
        'updated_at'
    ];
}
