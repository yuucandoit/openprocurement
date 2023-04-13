<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    protected $fillable = [
        'id',
        'po_id',
        'ppb_id',
        'receiver',
        'path_image',
    ];
    // public function dp()
    // {
    //     return $this->hasMany(CategoryPengajuanPembelian::class, 'department');
    // }
}
