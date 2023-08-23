<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class CategoryEcommerce extends Model
{
    use HasFactory;
    protected $table = 'category_ecommerce';
    protected $fillable = [
        'nama',
        'link',
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
    protected static $logName = 'Vendor Ec';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'nama',
        'link',]);
    }
}
