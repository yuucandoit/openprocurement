<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'travel';
    protected $fillable =
    [
        'name',
        'deleted_at'
    ];
    public function purposes()
    {
        return $this->morphMany(CategoryPengajuanPembelian::class, 'purpose');
    }
}
