<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTrack extends Model
{
    use HasFactory;
    protected $table = 'delivery_tracks';
    protected $fillable = [
        'id',
        'po_id',
        'ppb_id',
        'status',
    ];
    public function ppb(){
        return $this->belongsTo(CategoryPengajuanPembelian::class, 'ppb_id');
    }
}
