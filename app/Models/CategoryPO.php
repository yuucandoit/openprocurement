<?php

namespace App\Models;

use Carbon\Carbon;
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
        'no_resi',
        'first_estimate',
        'last_estimate',
        'creator_id',
        'creator_name',
        'approved_at_py',
        'note_bod_po',
        'note_bod_py',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payment_date' => 'date',
            'approved_at' => 'datetime',
            'approved_at_py' => 'datetime',
            'first_estimate' => 'date',
            'last_estimate' => 'date',
            'nilai' => 'float',
            'flag_delivery' => 'integer',
        ];
    }

    /**
     * Check if this PO has successfully delivered.
     */
    public function isDelivered(): bool
    {
        return $this->status === 'Delivery Success';
    }

    /**
     * Check if all other sibling POs under the same PR are also delivered.
     */
    public function areAllSiblingPosDelivered(): bool
    {
        return !self::where('ppb_id', $this->ppb_id)
            ->where('id', '!=', $this->id)
            ->where('status', '!=', 'Delivery Success')
            ->exists();
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }
    
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

    public function deliveryss()
    {
        return $this->hasMany(Delivery::class,'po_id');
    }

    public function generateTheCode($id,$created_date)
    {
        $year = Carbon::parse($created_date)->format('y');
        $month = Carbon::parse($created_date)->format('m');
        $po_id = str_pad($id,5,'0', STR_PAD_LEFT);
        $generatecode = strtoupper($po_id."/PO/SII/".$month."/".$year);
        return $generatecode;
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
