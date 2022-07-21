<?php

namespace App\Http\Controllers;



use App\Models\Category;
use App\Services\Categories\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\StoreRequest;


class CategoryController extends Controller
{

    public function index():JsonResponse
    {
       return response()->json(Category::with('products')->paginate(10));
    }

    /*
     * Сохранение
     */
    public function store(StoreRequest $request, CategoryService $categoryService):JsonResponse
    {
        if($categoryService->save($request->all())){
            return response()->json(["error"=>false]);
        }
        return response()->json([
            "error"=>true,
            "message"=>implode(',',$categoryService->errors)]);
    }

    /*
     * Обновление
     */
    public function update(StoreRequest $request,int $categoryId ,   CategoryService $categoryService):JsonResponse
    {
        if( $categoryService->update($categoryId,$request->all())){
            return response()->json(["error"=>false]);
        }
        return response()->json([
            "error"=>true,
            "message"=>implode(',',$categoryService->errors)]);
    }

    /*
     * Удаление
     */
    public function destroy(int $id, CategoryService $categoryService)
    {
        return response()->json([
            "error"=>!$categoryService->delete($id),
            "message"=>implode(',',$categoryService->errors)]);
    }
}
