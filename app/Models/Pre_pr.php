<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pre_pr extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'pre_prs';
    protected $fillable = [
        'id',
        'user_id',
        'project_id',
        'due_date',
        'deleted_at'
    ];

    public function partItem()
    {
        return $this->hasMany(PartItem_Pre_pr::class, 'pre_pr_id');
    }

    public function project()
    {
        return $this->belongsTo(ReferensiNamaProject::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    protected static $logFillable = true;
    protected static $logName = 'Pre_PR';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['id',
        'user_id',
        'project_id',
        'deleted_at'
        ]);
    }
}
