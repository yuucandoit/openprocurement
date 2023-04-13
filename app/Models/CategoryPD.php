<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPD extends Model
{
    use HasFactory;
    protected $table = 'category_pd';
    protected $fillable = [
        'id',
        'ppb_id',
        'po_id',
        'path_image',
        'signature',
        'approved_at'
    ];
}
