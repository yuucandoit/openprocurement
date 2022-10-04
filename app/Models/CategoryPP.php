<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPP extends Model
{
    use HasFactory;
    protected $table = 'category_pp';
    protected $fillable = [
        'nama',
        'alamat',
        'nik',
        'npwp_pp',
        'pkp'
    ];
    protected $hidden;

    
    public function vendors()
    {
        return $this->morphMany(CategoryPO::class, 'vendortable');
    }
}
