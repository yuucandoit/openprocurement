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
        'is_read',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
