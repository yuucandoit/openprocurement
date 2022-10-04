<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryEcommerce extends Model
{
    use HasFactory;
    protected $table = 'category_ecommerce';
    protected $fillable = [
        'nama',
        'link',
    ];
    protected $hidden;

    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendortable');
    }
}
