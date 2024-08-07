<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryPP extends Model
{
    use SoftDeletes;
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
        'cabang_bank',
        'deleted_at'
    ];
    protected $hidden;

    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendorable');
    }

    public function vendorBanks()
    {
        return $this->morphMany(VendorBank::class, 'vendor');
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
