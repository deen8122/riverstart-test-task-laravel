<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Services\Products\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Products\StoreRequest;

class ProductController extends Controller
{
    public static  int $ClientEventPaginateCount = 20;

    /**
     * Список товаров с возможностью применит фильтр
     */
    public function index(ProductFilter $request):JsonResponse
    {
       return response()->json(Product::filter($request)->with('categories')->paginate(self::$ClientEventPaginateCount));
    }

    /*
     * Сохранение
     */
    public function store(StoreRequest $request, ProductService $productService):JsonResponse
    {
        if($productService->save($request->all())){
            return response()->json(["error"=>false]);
        }
        return response()->json([
            "error"=>true,
            "message"=>implode(',',$productService->errors)]);
    }

    /*
     * Обновление
     */
    public function update(UpdateRequest $request,int $productId ,  ProductService $productService):JsonResponse
    {
        if( $productService->update($productId,$request->all())){
            return response()->json(["error"=>false]);
        }
        return response()->json([
            "error"=>true,
            "message"=>implode(',',$productService->errors)]);
    }

    /*
     * Удаление
     */
    public function destroy(Request $request, int $id, ProductService $productService)
    {
        return response()->json([
            "error"=>!$productService->delete($id),
            "message"=>implode(',',$productService->errors)]);
    }
}
