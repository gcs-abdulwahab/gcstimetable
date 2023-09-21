<?php

namespace App\Http\Requests;

use App\Rules\DaySlotTeacherCourseUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAllocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'course_id' => 'required',
            'teacher_id' => 'nullable',
            'day_id' => 'required',
            'slot_id' => 'required',
            'section_id' => 'required',
            'name' => 'nullable',
            'room_id' => 'required' ,new DaySlotTeacherCourseUniqueRule,
        ];
    }
    
}
