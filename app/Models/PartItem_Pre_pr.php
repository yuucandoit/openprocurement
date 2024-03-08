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
    ];

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
