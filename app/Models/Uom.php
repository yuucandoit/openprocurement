<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Uom extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'uom';
    protected $fillable = [
        'id',
        'name',
    ];
    protected static $logFillable = true;
    protected static $logName = 'Uom';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'name',
        ]);
    }
}
