<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->orWhere('username', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('ElenaLaviniaBeatriceSara')->plainTextToken;
                $response = ['token' => $token, 'user' => $user];

                return response($response, 200);
            } else {
                $response = ['message' => 'Password mismatch'];

                return response($response, 404);
            }
        } else {
            $response = ['message' => 'User does not exist'];

            return response($response, 404);
        }
    }
}
