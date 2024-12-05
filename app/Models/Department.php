<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'department';
    protected $fillable = [
        'id',
        'name',
        'permitted_purposes',
    ];
    public function dp()
    {
        return $this->hasMany(CategoryPengajuanPembelian::class, 'department');
    }
}
