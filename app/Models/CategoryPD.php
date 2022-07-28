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
        'user_id',
        'subject',
        'name',
        'tujuan',
        'lokasi',
        'jangka_waktu',
        'nominal',
        'no_rek',
        'item',
        'status',
        'created_at',
        'updated_at'

    ];
}
