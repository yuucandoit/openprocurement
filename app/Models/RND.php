<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RND extends Model
{
    use HasFactory;
    protected $table = 'RnD';
    protected $fillable =
    [
        'name',
    ];
    public function purposes()
    {
        return $this->morphMany(CategoryPengajuanPembelian::class, 'purpose');
    }
}
