<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    use FailedValidation;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'exists:categories,id',
            'title' => 'string|max:255',
            'price' => 'numeric',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
