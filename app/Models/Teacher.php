<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

/* {
        "id": 1,
        "name": "Nellie Powlowski",
        "personnel_number": "460443",
        "email": "willy.pollich@example.com",
        "cnic": "0069276929611",
        "phone_number": "1-423-709-7879",
        "bank_iban": "35368589580041126689711",
        "isMale": 1,
        "date_of_birth": null,
        "date_of_joining_in_this_college": null,
        "date_of_joining_govt_service": null,
        "date_of_joining_current_rank": null,
        "father_name": null,
        "seniority_number": 0,
        "qualification": "MPhil",
        "highest_degree_awarding_institute": null,
        "highest_degree_awarding_country": null,
        "highest_degree_awarding_year": null,
        "degree_title": null,
        "rank": "Assistant Professor",
        "position": "Regular",
        "department_id": 1,
        "isvisiting": 0,
        "isActive": 1,
        "created_at": "2023-09-06T23:14:20.000000Z",
        "updated_at": "2023-09-06T23:14:20.000000Z"
    }, */

    // blacklist
    protected $guarded = ['id'];



    // Teacher Belongs to Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Teacher has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }


    // Teacher model
    public function courses()
    {

            // Can be done using Eager Loading

        return $this->belongsToMany(Course::class, 'allocations')
            ->withPivot(['day_id', 'slot_id', 'room_id']);
                
            
    }
}
