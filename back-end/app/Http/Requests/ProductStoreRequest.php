<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'description' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'decimal:2'],
        ];
    }
}
