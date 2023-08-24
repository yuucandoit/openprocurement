<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'office';
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
