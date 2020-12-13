<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (bool) Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:5', 'max:128', 'required'],
            'description' => ['string', 'min:1', 'max:1024', 'required'],
            'price' => ['integer', 'min:1', 'max:50000'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']





        ];
    }
}
