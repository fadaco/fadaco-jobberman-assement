<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function saveUser(Request $request){

        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|string|unique:users',
            'first_name' => 'required|string',
            'surname' => 'string',
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }


       if(User::create($request->all())) {
           return $this->responseDisplay(201,'user created', $request->all());
       }
    }

    public function getUser(){
        return User::orderBy('id', 'DESC')->get();
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();

        if (isset($user)) {
            if ($user->delete()) {
                return $this->responseDisplay(200,'user deleted', $user);
            } else {
                return $this->responseDisplay(400,'operation fail');
            }
        } else {
            return $this->responseDisplay(401,'user not found');
        }
    }

    public function responseDisplay($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
