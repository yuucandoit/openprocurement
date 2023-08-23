<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Bank extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $table = 'banks';
    protected $fillable = [
        'id',
        'name',
        'alamat',
        'call_center'
    ];
    protected static $logFillable = true;
    protected static $logName = 'Bank';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'name',
            'alamat',
            'call_center']);
    }
}
