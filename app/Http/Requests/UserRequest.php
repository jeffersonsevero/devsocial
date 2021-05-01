<?php

namespace App\Http\Requests;

use App\Helpers\Message;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'password' => 'required',
            'birthdate' => 'date'

        ];
    }


    public function messages()
    {
        return [
            'required' => 'Preecha todos os campos',
            'email' => 'Insira um email válido',
            'date' => 'Insira uma data válida',
            'message' => 'Ouve erros'
        ];
    }



    protected function failedValidation(Validator $validator)
    {


        $response = Message::error($validator->errors()->first());

        $response = response()->json($response);

        throw new HttpResponseException($response);

    }

}
