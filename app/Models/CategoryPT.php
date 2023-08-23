<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryPT extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $table = "category_pt";
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp_kantor',
        'website',
        'nama_pic',
        'no_telp_pic',
        'email',
        'npwp_perusahaan',
        'pkp',
        'nib',
        'bidang_usaha',
        'no_rekening',
        'bank',
        'cabang_bank',
        'nama_penerima'
    ];

    public function pengajuanpembelian()
    {
        return $this->hasMany(PengajuanPembelian::class);
    }

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    // public function vendors()
    // {
    //     return $this->morphMany(PengajuanPembelian::class, 'vendorable');
    // }
    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendorable');
    }
    protected static $logFillable = true;
    protected static $logName = 'Vendor PT';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'nama',
        'alamat',
        'no_telp_kantor',
        'website',
        'nama_pic',
        'no_telp_pic',
        'email',
        'npwp_perusahaan',
        'pkp',
        'nib',
        'bidang_usaha',
        'no_rekening',
        'bank',
        'cabang_bank',
        'nama_penerima']);
    }
}
