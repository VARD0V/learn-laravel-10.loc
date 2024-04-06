<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //Метод для отображения всего
    public function index(){
        $categories = Category::all();
        if ($categories) {
            return response()->json($categories)->setStatusCode(200, 'Accept');
        }else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод для отображения текущего
    public function show($id){
        $category = Category::find($id);
        if ($category){
            return response()->json($category)->setStatusCode(200, 'Accept');
        } else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод создания
    public function store(CreateCategoryRequest $request)
    {
        $existingCategory = Category::where('name', $request->input('name'))->first();
        if ($existingCategory) {
            throw new ApiException(422, 'Категория с таким именем уже существует');
        }
        // Создаем новую категорию
        $category = new Category($request->all());
        $category->save();
        return response()->json($category)->setStatusCode(201, 'Created');
    }

    //Метод обновления
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->update($request->all());
            $category->save();
            return response()->json($category)->setStatusCode(200, 'Update complete');
        }else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }

    //Метод удаления
    public function destroy($id){
        $category = Category::find($id);
        if($category){
            Category::destroy($id);
            throw new ApiException(204, 'Complete destroy');
        } else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }
}
