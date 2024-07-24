<?php

namespace App\Http\Controllers\CustomerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    
    function update(Request $request, int $id) {

        $userModel = User::where('id', $id)->first();
        
        $userModel->name = $request->name;
        $userModel->email = $request->email;
        $userModel->password = Hash::make($request->password);
        $userModel->role_as = "0";

        $result = $userModel->update();
        
        if($result) {

            return response([
                "message" => $userModel,
                "status" => 200
            ]);

        }
        

    }

}
