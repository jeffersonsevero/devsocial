<?php

namespace App\services;

use App\Helpers\Message;
use App\Http\Requests\UserRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;

class UserService
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }



    public function create(UserRequest $request)
    {

        $data = $request->all();

        $user = User::where('email', $data['email'])->first();


        if ($user) {

            $response = Message::error("Usuário já cadastrado");

            return $response;
        }

        $password = $data['password'];

        $data['password'] = bcrypt($data['password']);

        try {

            User::create($data);

            $token = Auth::guard('api')->attempt([
                'email' => $data['email'],
                'password' => $password
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        if (!$token) {

            $response = Message::error("Token não foi criado");
            return $response;
        }


        $response = Message::success("Usuário criado com sucesso!", $token);

        return $response;
    }



    public function login(array $data){


        $token = Auth::guard('api')->attempt($data);

        if(!$token){

            $response = Message::error('Dados errados!');

            return $response;

        }


        $response = Message::success("Login efetuado com sucesso", $token);

        return $response;


    }




}