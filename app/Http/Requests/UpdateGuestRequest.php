<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuestRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>
                'required|max:255|unique:guests,email,' . preg_replace('/[^0-9]/', '', request()->path()),
            // lay id tren thanh url de bo qua unique cho email cua guest dang edit
//            'password' => 'required|min:6',
            'phone' => 'required|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'An email address is required',
            'password.required' => 'A password is required',
        ];
    }
}
