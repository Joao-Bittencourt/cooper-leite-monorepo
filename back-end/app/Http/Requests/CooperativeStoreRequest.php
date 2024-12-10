<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CooperativeStoreRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:cooperatives'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cooperatives'],
        ];
    }
}
