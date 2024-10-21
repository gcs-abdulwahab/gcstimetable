<?php

namespace App\Models;

use App\RoleEnum;
use App\RoleTrait;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use RoleTrait;

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
        'label',
    ];

    public static function booted()
    {
        parent::creating(function(User $user){
            if(is_null($user->institution_id) && $user->email != 'sadmin@gmail.com'){
                throw new \Exception('User must belongs to an instituion.');
            }
        });
    }


    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset("storage/$this->profile_photo_path")
            : generateAvatar($this->name);
    }

    public function getLabelAttribute() : string 
    {
        return RoleEnum::getLabel($this->roles->first()->name ?? '');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeInstitution($query, $value)
    {
        $query->where('institution_id', $value);
    }

    // Relationships

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
