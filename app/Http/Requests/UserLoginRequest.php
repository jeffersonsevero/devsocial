<?php

namespace App\Http\Requests;

use App\Helpers\Message;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



class UserLoginRequest extends FormRequest
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

            'email' => 'required|email',
            'password' => 'required'

        ];
    }


    public function messages()
    {
        return [
            'required' => 'Preencha todos os campos',
            'email' => 'Insira um e-mail válido'
        ];
    }



    protected function failedValidation(ValidationValidator $validator)
    {
        $response = Message::error($validator->errors()->first());

        $response = response()->json($response);

        throw new HttpResponseException($response);
    }



}
