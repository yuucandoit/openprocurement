<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPengajuanPembelian extends Model
{
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
        return $this->belongsTo(CategoryPO::class, 'id');
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

    public function signature()
    {
        return $this->hasMany(Invoicing::class,'ppb_id');
    }
    public function signaturepo()
    {
        return $this->hasMany(POSignature::class,'ppb_id');
    }

}
