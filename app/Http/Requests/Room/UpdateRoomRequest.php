<?php

namespace App\Http\Requests\Room;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_number' => 'sometimes|string|max:20|unique:rooms,room_number',
            'price_per_month' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:available,occupied,maintenance',
        ];
    }
}
