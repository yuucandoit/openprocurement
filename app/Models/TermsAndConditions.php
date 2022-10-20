<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndConditions extends Model
{
    use HasFactory;
    protected $table = 'terms_and_condition';
    protected $fillable = [
        'id',
        'term_condition',
    ];

    public function po()
    {
        return $this->hasMany(CategoryPO::class, 'term_conditions');
    }
}
