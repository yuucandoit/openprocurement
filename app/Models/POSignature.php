<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class POSignature extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'po_signatures';
    protected $fillable = [
        'id',
        'signature',
        'ppb_id',
        'deleted_at',
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }

}
