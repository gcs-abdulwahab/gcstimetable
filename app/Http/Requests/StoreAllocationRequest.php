<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreAllocationRequest extends FormRequest
{

    // do not redirect anywhere in case of failure
     public $redirect = "http://www.google.com";

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
        Log::info('StoreAllocationRequest: Rules method called.');

        
        return [
            'course_id' => 'required',
            'teacher_id' => 'nullable',
            'day_id' => 'required',
            'slot_id' => 'required',
            'section_id' => 'required',
            'name' => 'nullable',
            'room_id' => 'required',
            
        ];
    }
    
}
