<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class IsReadPrePRComment extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'is_read_pre_pr_comments';
    protected $fillable = [
        'user_id',
        'id_pre_pr_items',
        'comment_id',
        'is_read',
    ];

    public function users()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(PrePRComments::class , 'comment_id');
    }

    public function items()
    {
        return $this->belongsTo(PartItem_Pre_pr::class , 'id_pre_pr_items');
    }
}
