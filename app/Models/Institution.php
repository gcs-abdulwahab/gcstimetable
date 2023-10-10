<?php

namespace App\Models;

use App\Models\Day;
use App\Models\Department;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institution extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Institution has one Admin
    public function admin() : hasOne
    {
        return $this->hasOne(User::class)->where('role_id', 1);
    }

    // Institution has many Departments
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    // Institution has many Rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Institution has many departments and each department has many teachers  so return all the teachers of this Institution
    public function teachers()
    {
        return $this->hasManyThrough(Teacher::class, Department::class);
    }


    // Institution has many days
    public function days()
    {
        return $this->hasMany(Day::class);
    }

    // Institution has many slots
    public function slots(){
        return $this->hasMany(Slot::class);
    }







}
