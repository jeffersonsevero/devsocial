<?php
namespace App\Helpers;

class Message{


    public static function error(string $message){


        $data = [];
        $data["message"] = $message;
        $data["error"] = 1;

        return $data;

    }


    public static function success(string $message, string $token = null, array $data = null ){



        if($token){

            $data["message"] = $message;
            $data["token"] = $token;
            $data["error"] = 0;

            return $data;

        }

        if($data){
            $data["message"] = $message;
            $data["data"] = $data;
            $data["error"] = 0;


            return $data;

        }


        return [
            "message" => $message,
            "error" => 0
        ];


    }




}
