<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'location',
        'is_fast_track',
        'force_password_reset',
        'deleted_at'
    ];

    public function po()
    {
        return $this->hasMany(CategoryPO::class, 'atasan_po');
    }
    public function py()
    {
        return $this->hasMany(CategoryPD::class, 'atasan_py');
    }

    public function ppb()
    {
        return $this->hasMany(CategoryPengajuanPembelian::class, 'atasan_po');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_fast_track' => 'boolean',
            'force_password_reset' => 'boolean',
        ];
    }

    /**
     * Get the first role id of the user (for backward compatibility).
     */
    public function getRoleIdAttribute(): ?int
    {
        return $this->roles->first()?->id;
    }

    /**
     * Check if user has any of the given roles (supports role names or role IDs).
     */
    public function checkRole(array|int|string $roles): bool
    {
        return $this->hasAnyRole($roles);
    }

    protected static $logFillable = true;
    protected static $logName = 'Users';
    public function getActivitylogOptions() : LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'id',
            'name',
            'email',
        ]);
    }
}
