<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRead extends Model
{
    use HasFactory;
    protected $table = 'comment_reads';
    protected $fillable = [
        'id',
        'comment_id',
        'user_id',
        'is_read_bod',
        'is_read_user',
        'is_read_purchase',
        'is_read_finance',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
