<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoardRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:1', 'max:32', 'required', 'sometimes'],
            'description' => ['string', 'min:1', 'max:255', 'required', 'sometimes'],
            'price' => ['integer', 'min:1', 'max:9999', 'sometimes'],
        ];
    }
}
