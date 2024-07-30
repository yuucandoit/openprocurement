<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PartItem_Pre_pr extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'part_item__pre_prs';
    protected $fillable = [
        'id',
        'product_id',
        'pre_pr_id',
        'parent_item',
        'child_item',
        'qty',
        'buffer',
        'total',
        'desc',
        'link',
        'status',
        'deleted_at',
        'creator_id',
        'creator_name',
    ];

    public function prItems()
    {
        return $this->hasMany(PengajuanPembelian::class,'prepr_id');
    }

    public function comments()
    {
        return $this->hasMany(PrePRComments::class,'id_pre_pr_items', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


    public function unreadCommentsCount()
    {
        return $this->comments()
        ->leftJoin('is_read_pre_pr_comments', function ($join) {
            $join->on('pre_pr_comments.id', '=', 'is_read_pre_pr_comments.comment_id')
                 ->where('is_read_pre_pr_comments.user_id', auth()->id());
        })
        ->whereNull('is_read_pre_pr_comments.id') // No entry in the is_read_pre_pr_comments table
        ->orWhere(function($query) {
            $query->where('is_read_pre_pr_comments.is_read', false) // Or the entry exists but is_read is false
                  ->where('is_read_pre_pr_comments.user_id', auth()->id());
        })
        ->count();
    }

    protected static $logFillable = true;
    protected static $logName = 'PartItem_pre_pr';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'id',
        'pre_pr_id',
        'parent_item',
        'child_item',
        'qty',
        'buffer',
        'total',
        'desc',
        'link',
        'status',
        'deleted_at',
        ]);
    }
}
