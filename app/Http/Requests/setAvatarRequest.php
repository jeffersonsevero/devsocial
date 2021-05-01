<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Message;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;


class setAvatarRequest extends FormRequest
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

            "avatar" => "required|image|mimes:png,jpg|max:2048"

        ];
    }


    public function messages()
    {
        return [
            "required" => "Campo avatar obrigatório",
            "image" => "Arquivo precisa ser uma imagem",
            "mimes:png,jpg" => "O arquivo precisa ser do tipo PNG ou JPG",
            "max:2048" => "A imagem não pode ser maior que 2MB"
        ];
    }


    protected function failedValidation(ValidationValidator $validator)
    {
        $response = Message::error($validator->errors()->first());

        $response = response()->json($response);

        throw new HttpResponseException($response);
    }





}
