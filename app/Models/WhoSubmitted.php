<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoSubmitted extends Model
{
    use HasFactory;
    protected $table = 'who_submitted';
    protected $fillable = [
        'name',
    ];
    public function whs()
    {
        return $this->hasMany(CategoryPengajuanPembelian::class, 'ws');
    }
}
