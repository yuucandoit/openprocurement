<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasklistAtasanPayment extends Model
{
    use HasFactory;
    protected $table = 'tasklist_atasan_payments';
    protected $fillable = [
        'id',
        'term_id',
        'po_id',
    ];
}
