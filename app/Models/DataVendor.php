<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVendor extends Model
{
    use HasFactory;
    protected $table = "data_vendor";
    protected $fillable = [
        'npwp',
        'Pkp',
        'jenis_usaha'
    ];
    protected $hidden;
}
