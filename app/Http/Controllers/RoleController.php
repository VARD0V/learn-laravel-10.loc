<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    //Метод для отображения всего
    public function index(){
        $roles = Role::all();
        if ($roles) {
            return response()->json($roles)->setStatusCode(200, 'Accept');
        }else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод для отображения текущего
    public function show($id){
        $role = Role::find($id);
        if ($role){
            return response()->json($role)->setStatusCode(200, 'Accept');
        } else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод создания
    public function store(CreateRoleRequest $request)
    {
        $role = new Role($request->all());
        $role->save();
        return response()->json($role)->setStatusCode(201, 'Created');
    }

    //Метод обновления
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->update($request->all());
            $role->save();
            return response()->json($role)->setStatusCode(200, 'Update complete');
        }else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }

    //Метод удаления
    public function destroy($id){
        $role = Role::find($id);
        if($role){
            Role::destroy($id);
            throw new ApiException(204, 'Complete destroy');
        } else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }
}
