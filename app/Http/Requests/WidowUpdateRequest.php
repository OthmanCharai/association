<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WidowUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'cnss' => ['required', 'string'],
            'cin' => ['required', 'string',  Rule::unique('widows')->ignore($this->id)],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'priority' => ['required'],
        ];
    }
}
