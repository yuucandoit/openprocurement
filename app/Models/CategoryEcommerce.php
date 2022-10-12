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

    public function vendor()
    {
        return $this->morphMany(CategoryPO::class, 'vendorable');
    }
}
