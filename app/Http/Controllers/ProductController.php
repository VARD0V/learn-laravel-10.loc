<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Метод для отображения всего
    public function index(){
        $products = Product::all();
        if ($products) {
            return response()->json($products)->setStatusCode(200, 'Accept');
        }else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод для отображения текущего
    public function show($id){
        $product = Product::find($id);
        if ($product){
            return response()->json($product)->setStatusCode(200, 'Accept');
        } else{
            throw new ApiException(404, 'Not found');
        }
    }

    //Метод создания
    public function store(CreateProductRequest $request)
    {
        $product = new Product($request->all());
        $product->save();
        return response()->json($product)->setStatusCode(201, 'Created');
    }

    //Метод обновления
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($request->all());
            $product->save();
            return response()->json($product)->setStatusCode(200, 'Update complete');
        }else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }

    //Метод удаления
    public function destroy($id){
        $product = Product::find($id);
        if($product){
            Product::destroy($id);
            throw new ApiException(204, 'Complete destroy');
        } else{
            throw new ApiException(404, 'Категория не найдена');
        }
    }
}
