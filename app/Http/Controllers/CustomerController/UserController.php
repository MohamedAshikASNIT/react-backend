<?php

namespace App\Http\Controllers\CustomerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    
    public function register(Request $request) {

        
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        $userModel = new User;

        $userModel->name = $name;
        $userModel->email = $email;
        $userModel->password = $password;

        $result = $userModel->save();

        return $result;


    }


    public function login(Request $request) {
        
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if($user) {

            $result = Hash::check($password, $user->password);
            
            if($result) {
                
                return response([
                    "message" => $user,
                    "status" => 200
                ]);

            } else {

                return response([

                    "message" => "Username or Password Incorrect!",
                    "status" => 404
                ]);

            }

            
        } else {
            
            return response([
                "result" => "Account Not Available",
                "status" => 404
            ]);

        }
        

    }

}
