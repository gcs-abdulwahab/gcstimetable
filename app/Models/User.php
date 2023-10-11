<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;

use Filament\Models\Contracts\FilamentUser;
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

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('sadmin');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

    ];

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
        // 'role_id' => Role::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // create a method  isSuperadmin
    public function isSuperadmin() : bool
    {
        return $this->hasRole('sadmin');
    }

    // create a method isInstitutionAdmin
    public function isInstitutionAdmin() : bool
    {
        return $this->hasRole('iadmin');
    }
    // create a method isDepartmentAdmin
    public function isDepartmentAdmin() : bool
    {
        return $this->hasRole('dadmin');
    }


//     /**
//      * The relationships that should always be loaded.
//      */
//     protected $with = [
//         'institution',
//     ];

//     // User belongs to one Institution
//     public function institution() : BelongsTo
//     {
//         return $this->belongsTo(Institution::class);
//     }
}
