<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDV extends Model
{
    use HasFactory;

    protected $table = "category_dv";
    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
        'email',
    ];
    protected $hidden;
}
