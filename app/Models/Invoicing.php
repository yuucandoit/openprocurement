<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicing extends Model
{
    use HasFactory;

    protected $table = 'invoicing';
    protected $fillable = [
        'id',
        'signature',
        'ppb_id',
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }

    public function atasans()
    {
        return $this->belongsTo(User::class, 'atasan_py');
    }
}
