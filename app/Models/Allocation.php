<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Allocation extends Model
{
    use HasFactory;

    protected $with = [
        'course', 
        'teacher',
        'room', 
        'slot', 
        'day', 
        'section.semester'
    ];

    protected static function booted()
    {
        static::addGlobalScope('teacher', function ($builder) {
            $builder->with(['teacher' => function ($query) {
                $query->select('id', 'name', 'email');
            }]);
        });
    }

    // create a function hasTeacher if teacher id is not null then return true else false
    public function hasTeacher(): bool
    {
        return (bool) $this->teacher_id;
    }

    // create a function hasCourse if course id is not null then return true else false
    public function hasCourse(): bool
    {
        return (bool) $this->course_id;
    }

    // create a function hasRoom if room id is not null then return true else false
    public function hasRoom(): bool
    {
        return (bool) $this->room_id;
    }

    // create a function has Section if section id is not null then return true else false
    public function hasSection(): bool
    {
        return (bool) $this->section_id;
    }

    public function hasDay(): bool
    {
        return (bool) $this->day_id;
    }

    public function hasSlot(): bool
    {
        return (bool) $this->slot_id;
    }

    public function getExistingAllocation($fields): object
    {
        $query = self::query();
        foreach ($fields as $key => $value) {
            $query->where($key, $value);
        }

        return $query->first();
    }

    // create a function doesExists that accepts the array of fields like day_id , slot_id , teacher_id , room_id , course_id , section_id
    // and check if the allocation is unique or not
    // the parameter list is dynamic and where query should be updated accordingly

    public function doesExist(array $fields): bool
    {
        $query = self::query();
        foreach ($fields as $key => $value) {
            $query->where($key, $value);
        }

        return $query->exists();
    }

    // create dynamic queryscope complete  on passing the boolean true  it returns the complete allocations and vice verca
    // and by default its true
    public function scopeComplete($query, $complete = true)
    {
        if ($complete) {
            return $query->whereNotNull('day_id')
                ->whereNotNull('slot_id')
                ->whereNotNull('teacher_id')
                ->whereNotNull('room_id')
                ->whereNotNull('course_id')
                ->whereNotNull('section_id');
        }

        return $query->whereNull('day_id')
            ->orWhereNull('slot_id')
            ->orWhereNull('teacher_id')
            ->orWhereNull('course_id')
            ->orWhereNull('room_id')
            ->orWhereNull('section_id');
    }

    // courses
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // teachers
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // rooms
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // slots
    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    // days
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    // sections
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function timetable() : BelongsTo
    {
        return $this->belongsTo(TimeTable::class);
    }
}
