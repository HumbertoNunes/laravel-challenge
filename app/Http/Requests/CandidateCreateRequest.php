<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return empty(auth()->user()->profile);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'course' => ['required', 'string', 'min:5', 'max:30'],
            'biography' => ['required', 'string', 'min:5', 'max:70'],
        ];
    }
}
