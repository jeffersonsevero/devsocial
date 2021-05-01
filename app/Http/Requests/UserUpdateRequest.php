<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Message;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'birthdate' => 'date',
            'work' => 'string',
            'city' => 'string'

        ];
    }


    public function messages()
    {
        return [
            'required' => 'Campo obrigatório',
            'email' => 'Insira um e-mail válido',
            'string' => 'Campo precisa ser texto'
        ];
    }




    protected function failedValidation(Validator $validator)
    {

        $response = Message::error($validator->errors()->first());

        $response = response()->json($response);

        throw new HttpResponseException($response);

    }


}
