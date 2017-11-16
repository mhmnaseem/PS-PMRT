<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        $rules = [
            'expense_type' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'images'=>'image|mimes:jpeg,jpg,png,bmp|min:1|max:5000'

        ];
//        $images = count($this->input('images'));
//        foreach(range(0, $images) as $index) {
//            $rules['images.' . $index] = 'image|mimes:jpeg,jpg,png,bmp|min:1|max:5000';
//        }

        return $rules;
    }
}
