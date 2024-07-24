<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrePRComments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pre_pr_comments';
    protected $fillable = [
        'user_id',
        'id_pre_pr',
        'id_pre_pr_items',
        'comment',
    ];

    public function users()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function pre_pr()
    {
        return $this->belongsTo(Pre_pr::class , 'id_pre_pr');
    }

    public function items()
    {
        return $this->belongsTo(PartItem_Pre_pr::class , 'id_pre_pr_items');
    }

}
