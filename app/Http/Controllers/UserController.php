<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $loggedUser;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api');
        $this->userService = $userService;

        $this->loggedUser = auth()->user();
    }





    public function update(UserUpdateRequest $request){


        $data = $request->all();

        return response()->json($this->userService->update($data));



    }



}
