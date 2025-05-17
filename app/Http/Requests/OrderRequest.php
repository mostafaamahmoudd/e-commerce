<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'total_amount' => 'required|numeric|min:1',
            'status' => 'required|string|in:pending,processing,delivered,cancelled',
            'payment_method' => 'nullable|string|in:cash,card,bank,other',
            'transaction_id' => 'nullable|string|exists:transactions,id',
        ];
    }
}
