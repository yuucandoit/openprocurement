<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryPT extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = "category_pt";
    protected $fillable = [
        'id',
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
        'nama_penerima',
        'deleted_at'
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

    public function vendorBanks()
    {
        return $this->morphMany(VendorBank::class, 'vendor');
    }

    protected static $logFillable = true;
    protected static $logName = 'Vendor PT';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'id',
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
