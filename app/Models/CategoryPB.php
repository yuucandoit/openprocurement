<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPB extends Model
{
    use HasFactory;
    protected $table = 'category_pb';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'subject',
        'status',
        'acc_at',
        'created_at',
        'updated_at'
    ];
}
