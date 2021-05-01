<?php

namespace App\Services;


use App\Helpers\Message;
use App\Http\Requests\setAvatarRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;
use Intervention\Image\Facades\Image;

class UserService
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = Auth::user();
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



    public function login(array $data)
    {


        $token = Auth::guard('api')->attempt($data);

        if (!$token) {

            $response = Message::error('Dados errados!');

            return $response;
        }


        $response = Message::success("Login efetuado com sucesso", $token);

        return $response;
    }


    public function logout()
    {
        if (Auth::user()) {

            Auth::logout();

            $response = Message::success("Deslogado");
            return $response;
        }

        return [];
    }





    public function refresh()
    {

        $token = auth()->refresh();

        $response = Message::success('', $token);
    }




    public function update(array $data)
    {


        try {

            $user = $this->user->where('email', $data['email'])->first();

            if(!$user){

                return Message::error("Usuário não encontrado!");


            }
            $user->update($data);
            return Message::success("Usuário atualizado com sucesso");

        } catch (Exception $e) {
            return Message::error($e->getMessage());

        }
    }




    public function setAvatar(setAvatarRequest $request){

        $image = $request["avatar"];

        $name = time() . "." . $image->extension();

        $destPath = public_path("/media/avatars");


        $img = Image::make($image->path())->fit(200,200)->save("{$destPath}/{$name}");

        $this->user->avatar = $name;
        $this->user->save();

        dd(url("/media/avatars/{$name}"));


        return Message::success("Avatar salvo com sucesso!", null, ["url" => url("/media/avatars/{$name}")]);



    }
}
