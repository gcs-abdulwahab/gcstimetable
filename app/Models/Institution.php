<?php

namespace App\Models;

use App\Enums\User\Role;
use App\Models\Day;
use App\Models\Department;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institution extends Model
{
    use HasFactory;

    


    // Institution has many Departments
    public function departments() : HasMany
    {
        return $this->hasMany(Department::class);
    }

    // Institution has many Rooms
    public function rooms() : HasMany
    {
        return $this->hasMany(Room::class);
    }

    // Institution has many departments and each department has many teachers  so return all the teachers of this Institution
    public function teachers() : HasManyThrough
    {
        return $this->hasManyThrough(Teacher::class, Department::class);
    }

    // Institution has many days
    public function days() : HasMany
    {
        return $this->hasMany(Day::class);
    }

    // Institution has many slots
    public function slots() : HasMany
    {
        return $this->hasMany(Slot::class);
    }







}
