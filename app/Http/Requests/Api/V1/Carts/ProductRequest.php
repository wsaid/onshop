<?php

namespace App\Http\Requests\Api\V1\Carts;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => [
                'required',
                'int',
                'gt:0'
            ],
            'purchasable_id' => [
                'required',
                'int'
            ],
            'purchasable_type' => [
                'required',
                'string',
                'in:variant,bundle'
            ]
        ];
    }
}
