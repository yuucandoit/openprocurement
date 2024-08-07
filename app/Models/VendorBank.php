<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class VendorBank extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;
    protected $table = 'vendor_banks';
    protected $fillable = [
        'id',
        'vendor_type',
        'vendor_id',
        'bank_id',
        'no_rekening',
        'nama_penerima',
    ];

    public function rel_bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function vendor()
    {
        return $this->morphTo();
    }

    protected static $logFillable = true;
    protected static $logName = 'vendor_banks';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'vendor_type',
            'vendor_id',
            'bank_id',
            'no_rekening',
        ]);
    }
}
