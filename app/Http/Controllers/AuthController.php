<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api')->except(['login', 'create', 'unauthorized' ]);
        $this->userService = $userService;


    }


    public function create(UserRequest $request){

        $response = $this->userService->create($request);

        return response()->json($response);

    }



    public function unauthorized(){

        $response = Message::error("Não autorizado!");

        return response()->json($response, 401);

    }



    public function login(UserLoginRequest $request){

        $data = $request->all();
        $response = $this->userService->login($data);

        return response()->json($response);


    }


    public function logout(){


        $response = $this->userService->logout();

        return response()->json($response);

    }




    public function refresh(){

        $response = $this->userService->refresh();

        return response()->json($response);

    }





}
