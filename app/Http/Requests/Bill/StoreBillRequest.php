<?php

namespace App\Http\Requests\Bill;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
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
            'room_tenant_id' => 'required|exists:room_tenants,id',
            'bill_month' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date|after_or_equal:bill_month',
            'fine_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:unpaid,paid,overdue',
        ];
    }
}
