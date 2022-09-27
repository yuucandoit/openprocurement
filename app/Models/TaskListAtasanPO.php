<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskListAtasanPO extends Model
{
    use HasFactory;
    protected $table = 'task_list_atasan_po';
    protected $fillable = [
        'id',
        'term_id',
        'po_id',
    ];
}
