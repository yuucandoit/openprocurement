<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DeliveryTrack extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;
    protected $table = 'delivery_tracks';
    protected $fillable = [
        'id',
        'po_id',
        'ppb_id',
        'creator_id',
        'creator_name',
        'status',
    ];

    public function ppb(){
        return $this->belongsTo(CategoryPengajuanPembelian::class, 'ppb_id');
    }

    public function po(){
        return $this->belongsTo(CategoryPO::class ,'po_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    protected static $logFillable = true;
    protected static $logName = 'Delivery Track';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'po_id',
            'ppb_id',
            'creator_id',
            'creator_name',
            'status',
        ]);
    }
}
