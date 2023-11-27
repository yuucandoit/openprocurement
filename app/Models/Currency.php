<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Currency extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'currency';
    protected $fillable = [
        'id',
        'name',
        'code',
    ];
    protected static $logFillable = true;
    protected static $logName = 'Currency';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'name',
            'code',
        ]);
    }
}
