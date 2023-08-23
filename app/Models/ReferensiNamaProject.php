<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReferensiNamaProject extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $table = 'referensi_nama_project';
    protected $fillable = [
        'id',
        'name'
    ];

    public function purposes()
    {
        return $this->morphMany(CategoryPengajuanPembelian::class, 'purpose');
    }

    protected static $logFillable = true;
    protected static $logName = 'Code Project';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'name']);
    }
}
