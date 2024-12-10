<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'cooperative_id' => ['required', 'integer', 'exists:cooperatives,id'],
            'amount' => ['required', 'numeric', 'decimal:4'],
            'type' => ['required', 'string', 'in:I,O'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
            'active' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
