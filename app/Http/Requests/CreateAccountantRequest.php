<?php

namespace App\Http\Requests;

use App\Models\Secretary;
use Illuminate\Foundation\Http\FormRequest;

class CreateAccountantRequest extends FormRequest
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
        return Secretary::$rules;
    }
}
