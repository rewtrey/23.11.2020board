<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoardRequest extends FormRequest
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
            'title' => ['string', 'min:1', 'max:32', 'required'],
            'description' => ['string', 'min:1', 'max:255', 'required'],
            'price' => ['integer', 'min:1', 'max:9999'],
            'created_at' => ['integer', 'min:1', 'max:9999'],

        ];
    }
}
