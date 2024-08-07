<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryPO extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'category_po';
    protected $fillable = [
        'id',
        'ppb_id',
        'item_ppid',
        'term_conditions',
        'vendorable_type',
        'vendorable_id',
        'atasan_po',
        'quotation',
        'signature',
        'status',
        'path_quotation',
        'path_invoice',
        'payment_type',
        'id_vendor_bank',
        'no_rekening',
        'va_code',
        'payment_date',
        'payment_purpose',
        'nilai',
        'ket_pajak',
        'matauang',
        'notes',
        'code_po',
        'atasan_po',
        'atasan_py',
        'approved_at',
        'flag_delivery',
        'approved_at_py',
        'note_bod_po',
        'note_bod_py',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function ppb()
    {
        return $this->belongsTo(CategoryPengajuanPembelian::class);
    }
    public function items()
    {
        return $this->belongsTo(PengajuanPembelian::class, 'item_ppid');
    }
    public function pengajuanDana()
    {
        return $this->hasMany(CategoryPD::class, 'po_id');
    }
    public function term()
    {
        return $this->belongsTo(TermsAndConditions::class, 'term_conditions');
    }
    public function itempo()
    {
        return $this->hasMany(ItemPO::class, 'po_id');
    }
    public function atasans()
    {
        return $this->belongsTo(User::class, 'atasan_po');
    }
    public function atasanpy()
    {
        return $this->belongsTo(User::class, 'atasan_py');
    }
    public function vendorable()
    {
        return $this->morphTo();
    }
    public function deliveryStatus()
    {
        return $this->hasMany(DeliveryTrack::class, 'po_id');
    }
    public function vendorRek()
    {
        return $this->belongsTo(VendorBank::class, 'id_vendor_bank');
    }

    protected static $logFillable = true;
    protected static $logName = 'PO';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'ppb_id',
        'item_ppid',
        'term_conditions',
        'vendorable_type',
        'vendorable_id',
        'atasan_po',
        'quotation',
        'signature',
        'status',
        'path_quotation',
        'path_invoice',
        'payment_type',
        'id_vendor_bank',
        'no_rekening',
        'va_code',
        'payment_date',
        'payment_purpose',
        'nilai',
        'ket_pajak',
        'matauang',
        'notes',
        'code_po',
        'atasan_po',
        'atasan_py',
        'approved_at',
        'rejected_at',
        'flag_delivery',
        'approved_at_py',
        'note_bod_po',
        'note_bod_py',
        'created_at',
        'updated_at',
        'deleted_at']);
    }

}
