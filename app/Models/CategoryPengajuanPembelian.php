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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'check_po_timestamp' => 'datetime',
            'w_approval_po_timestamp' => 'datetime',
            'w_finance_pay_timestamp' => 'datetime',
            'p_finance_timestamp' => 'datetime',
            'dateline' => 'date',
            'logistic_check' => 'integer',
        ];
    }

    /**
     * Standard relationship name for Purchase Orders under this PR.
     */
    public function purchaseOrders()
    {
        return $this->hasMany(CategoryPO::class, 'ppb_id');
    }

    /**
     * Real-time breakdown of all POs under this PR.
     * Tracks delivered, in-transit, and pending check POs to prevent forgotten items.
     */
    public function getPoProgressAttribute(): array
    {
        $allPo = $this->quot;
        $total = $allPo->count();

        if ($total === 0) {
            return [
                'total' => 0,
                'delivered' => 0,
                'otw' => 0,
                'pending_check' => 0,
                'waiting_approval' => 0,
                'percentage' => 0,
                'is_all_delivered' => false,
                'has_pending_actions' => false,
                'status_label' => 'No POs Created',
                'badge_class' => 'badge-light',
            ];
        }

        $delivered = $allPo->where('status', 'Delivery Success')->count();
        $pendingCheck = $allPo->where('status', 'Cross Check PO')->count();
        $waitingApproval = $allPo->where('status', 'Waiting For PO Approval')->count();
        $rejected = $allPo->filter(fn($p) => str_contains(strtolower($p->status ?? ''), 'reject'))->count();
        $otw = max(0, $total - $delivered - $pendingCheck - $waitingApproval - $rejected);

        $percentage = $total > 0 ? (int) round(($delivered / $total) * 100) : 0;
        $isAllDelivered = ($total > 0 && $delivered === $total);
        $hasPendingActions = ($pendingCheck > 0 || ($delivered > 0 && !$isAllDelivered));

        $statusLabel = match (true) {
            $isAllDelivered => 'All POs Delivered (100%)',
            $delivered > 0 => "Partial Delivery ({$delivered}/{$total} POs)",
            $pendingCheck > 0 => "Needs Check PO ({$pendingCheck} POs)",
            $waitingApproval > 0 => "Waiting Approval ({$waitingApproval} POs)",
            default => "In Progress ({$delivered}/{$total})",
        };

        $badgeClass = match (true) {
            $isAllDelivered => 'badge-success',
            $delivered > 0 => 'badge-warning',
            $pendingCheck > 0 => 'badge-danger',
            default => 'badge-info',
        };

        return [
            'total' => $total,
            'delivered' => $delivered,
            'otw' => $otw,
            'pending_check' => $pendingCheck,
            'waiting_approval' => $waitingApproval,
            'rejected' => $rejected,
            'percentage' => $percentage,
            'is_all_delivered' => $isAllDelivered,
            'has_pending_actions' => $hasPendingActions,
            'status_label' => $statusLabel,
            'badge_class' => $badgeClass,
        ];
    }

    /**
     * Scope to find PRs with partial deliveries (at least 1 delivered, but not all delivered).
     */
    public function scopeWithIncompleteDelivery($query)
    {
        return $query->whereHas('quot', function ($q) {
            $q->where('status', 'Delivery Success');
        })->whereHas('quot', function ($q) {
            $q->where('status', '!=', 'Delivery Success');
        });
    }

    /**
     * Scope to find PRs that have POs waiting for Check PO.
     */
    public function scopeWithPendingCheckPo($query)
    {
        return $query->whereHas('quot', function ($q) {
            $q->where('status', 'Cross Check PO');
        });
    }

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
