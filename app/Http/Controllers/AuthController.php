<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = request(['login', 'password']);
        if(Auth::attempt($credentials)){
            throw new ApiException(401, 'Ошибка аутентификации');
        }
        $user = Auth::user();
        $user->token = Hash::make(microtime(true) * 1000 . Str::random() . $user->login);
        $user->save();
        return response()->json(['token'=>$user->token])->setStatusCode(200);
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()->json()->setStatusCode(204);
    }

}
