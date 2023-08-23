<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryPP extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $table = 'category_pp';
    protected $fillable = [
        'nama',
        'email',
        'contact',
        'alamat',
        'nik',
        'npwp_pp',
        'pkp',
        'no_rekening',
        'bank',
        'cabang_bank'
    ];
    protected $hidden;


    // public function vendors()
    // {
    //     return $this->morphMany(PengajuanPembelian::class, 'vendorable');
    // }
    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendorable');
    }
    protected static $logFillable = true;
    protected static $logName = 'Vendor PP';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'nama',
            'email',
            'contact',
            'alamat',
            'nik',
            'npwp_pp',
            'pkp',
            'no_rekening',
            'bank',
            'cabang_bank']);
    }
}
