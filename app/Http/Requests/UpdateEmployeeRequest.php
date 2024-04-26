<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' =>
                'required|max:255|unique:employees,email,' . preg_replace('/[^0-9]/', '', request()->path()),
            // lay id tren thanh url de bo qua unique cho email cua employee dang edit
            'role' => 'required',
            'phone' => 'required|max:20',
        ];
    }
}
