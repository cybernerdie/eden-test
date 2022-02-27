<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'fullname' =>  [ 'required', 'string', 'max:255'],
            'country_id' => [ 'required', 'integer', Rule::in([ 1, 2 ])],
            'role_id' => [ 'required', 'integer', Rule::in([ 9, 18 ])],
            'email' =>  [ 'required', 'email', 'max:255', 'unique:users,email'],
            'password' =>  ['required', 'string', 'max:255', 'min:6' ],
            'location' =>  ['required', 'string', 'max:100'],
        ];
    }

}
