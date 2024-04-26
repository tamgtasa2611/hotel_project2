<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'created_date' => 'required|date',
            'status' => 'required',
            'guest_id' => 'required|integer',
            'room_id' => 'required|integer',
            'admin_id' => 'integer',
            'checkin' => 'required|date|before:checkout|after:yesterday',
            'checkout' => 'required|date|after:checkin',
            'guest_num' => 'required|integer',
            'total_price' => 'required|decimal:2',
        ];
    }
}
