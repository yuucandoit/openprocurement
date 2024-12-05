<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryPengajuanPembelian extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'category_pengajuan_pembelian';
    protected $fillable = [
        'id',
        'user_id',
        'date_ps',
        'atasan',
        'atasan_po',
        'atasan_py',
        'note_bod_pr',
        'note_bod_po',
        'note_bod_py',
        'note_purchase',
        'note_finance',
        'matauang',
        'logistic_check',
        'ws',
        'status',
        'purpose_type',
        'purpose_id',
        'desc',
        'purpose',
        'department',
        'type_pr',
        'process_by',
        'file_spk',
        'file_pr',
        'send_to',
        'ppn',
        'code_pengajuan',
        'dateline',
        'dateline_time',
        'signature',
        'approved_at',
        'created_at',
        'updated_at',
        'check_po_timestamp',
        'w_approval_po_timestamp',
        'w_finance_pay_timestamp',
        'p_finance_timestamp',
        'deleted_at'
    ];

    public function pt()
    {
        return $this->belongsTo(CategoryPT::class);
    }

    public function op()
    {
        return $this->belongsTo(CategoryPP::class);
    }
    public function ec()
    {
        return $this->belongsTo(CategoryEcommerce::class);
    }

    public function atasans()
    {
        return $this->belongsTo(User::class, 'atasan_po');
    }

    public function atasanpymnt()
    {
        return $this->belongsTo(User::class, 'atasan_py');
    }

    public function purpose()
    {
        return $this->morphTo();
    }
    public function po()
    {
        return $this->belongsTo(CategoryPO::class, 'id', 'ppb_id');
    }
    public function pd()
    {
        return $this->belongsTo(Invoicing::class, 'ppb_id');
    }
    public function userid()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ws()
    {
        return $this->belongsTo(WhoSubmitted::class);
    }

    public function whosubmit()
    {
        return $this->belongsTo(WhoSubmitted::class, 'ws');
    }

    public function dps()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function bod()
    {
        return $this->belongsTo(User::class, 'atasan');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'ppb_id');
    }

    public function itemppn()
    {
        return $this->hasMany(PengajuanPembelian::class,'pp_id');
    }

    public function quot()
    {
        return $this->hasMany(CategoryPO::class,'ppb_id');
    }

    public function has_po()
    {
        return $this->hasMany(CategoryPO::class, 'ppb_id')
                ->where(function($query) {
                    $query->where('flag_delivery', '!=', 2)
                          ->orWhereNull('flag_delivery'); // Hanya ambil yang bukan 2 atau null
                });
    }

    public function signature()
    {
        return $this->hasMany(Invoicing::class,'ppb_id');
    }
    public function signaturepo()
    {
        return $this->hasMany(POSignature::class,'ppb_id');
    }

    public function generateTheCode($id,$created_date)
    {
        $year = Carbon::parse($created_date)->format('y');
        $month = Carbon::parse($created_date)->format('m');
        $ppb_id = str_pad($id,5,'0', STR_PAD_LEFT);
        $generatecode = strtoupper($ppb_id."/PPB/SII/".$month."/".$year);
        return $generatecode;
    }

    protected static $logFillable = true;
    protected static $logName = 'PR';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['id',
        'user_id',
        'date_ps',
        'atasan',
        'atasan_po',
        'atasan_py',
        'note_bod_pr',
        'note_bod_po',
        'note_bod_py',
        'note_purchase',
        'note_finance',
        'matauang',
        'ws',
        'status',
        'purpose_type',
        'purpose_id',
        'desc',
        'purpose',
        'department',
        'send_to',
        'ppn',
        'dateline',
        'created_at',
        'updated_at',
        'check_po_timestamp',
        'w_approval_po_timestamp',
        'w_finance_pay_timestamp',
        'p_finance_timestamp',
        'deleted_at',]);
    }

}
