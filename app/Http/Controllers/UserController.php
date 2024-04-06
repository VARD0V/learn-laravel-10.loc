<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //Метод для отображения всего
    public function index(){
        $users = User::all();
        if ($users) {
            return response()->json($users)->setStatusCode(200, 'Accept');
        }else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод для отображения текущего
    public function show($id){
        $user = User::find($id);
        if ($user){
            return response()->json($user)->setStatusCode(200, 'Accept');
        } else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод создания
    public function store(CreateUserRequest $request)
    {
        $user = new User($request->all());
        $user->role_id = Role::where('code', 'user')->first()->id;
        $user->save();
        return response()->json($user)->setStatusCode(201, 'Created');
    }

    //Метод обновления
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($request->all());
            $user->save();
            return response()->json($user)->setStatusCode(200, 'Update complete');
        }else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }

    //Метод удаления
    public function destroy($id){
        $user = User::find($id);
        if($user){
            User::destroy($id);
            throw new ApiException(204, 'Complete destroy');
        } else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }
}
