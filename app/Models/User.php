<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        $BrandName = "";
        if ($this->isInstitutionAdmin()) {
            $BrandName = $this->institution->name;
        }

        if ($this->isDepartmentAdmin()) {
            $BrandName = $this->department->name;
        }

        if ($this->isSuperadmin()) {
            $BrandName = "Super Admin Panel";
        }

        if ($BrandName) {
            $panel->brandName($BrandName);
        }

        return true;
    }


    // create a method  isSuperadmin

    public function isInstitutionAdmin(): bool
    {
        return $this->hasRole('iadmin');
    }

    // create a method isInstitutionAdmin

    public function isDepartmentAdmin(): bool
    {
        return $this->hasRole('dadmin');
    }

    // create a method isDepartmentAdmin

    public function isSuperadmin(): bool
    {
        return $this->hasRole('sadmin');
    }


    // User belongs to one Institution

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
