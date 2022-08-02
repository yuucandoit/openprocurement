<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatePerson extends Model
{
    use HasFactory;
    protected $table = 'private_person';
    protected $fillable = [
        'nama',
        'alamat',
        'nik',
    ];
    protected $hidden;
}
