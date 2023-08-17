<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'actually_price' => 'required|integer|min:0',
            'sales_price' => 'required|integer|min:0',
            'total_stock' => 'required|integer|min:0',
            'unit' => 'required|string',
            'more_information' => 'nullable|string',

            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }
}
