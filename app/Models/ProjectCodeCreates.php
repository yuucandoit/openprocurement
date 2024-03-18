<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectCodeCreates extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use HasFactory;
    protected $table = 'project_code_creates';
    protected $fillable = [
        'id',
        'user_id',
        'approver_id',
        'project_code',
        'status',
        'notes',
        'approved_at',
        'cancel_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'approver_id');
    }

    protected static $logFillable = true;
    protected static $logName = 'CodeProjectReqs';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'id',
        'user_id',
        'approver_id',
        'project_code',
        'created_at',
        'updated_at',
        'deleted_at']);
    }
}
