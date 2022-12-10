<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildUpdateRequest extends FormRequest
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
            'username' => ['required', 'string'],
            'gender' => ['required', 'in:Male,Female'],
            'birth_day' => ['required', 'date'],
            'educated' => ['required'],
            'vaccinated' => ['required'],
            'widow_id' => ['required', 'integer', 'exists:widows,id'],
            'sponsor_id' => ['required', 'integer', 'exists:sponsors,id'],
        ];
    }
}
