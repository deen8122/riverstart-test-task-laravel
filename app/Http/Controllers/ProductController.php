<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Client\ClientEvent;
use App\Models\Product;
use App\Services\Clients\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClientEvents\StoreRequest;

class ProductController extends Controller
{
    public static  int $ClientEventPaginateCount = 20;

    /**
     *
     */
    public function index(ProductFilter $request):JsonResponse
    {
       return response()->json(Product::filter($request)->with('categories')->paginate(self::$ClientEventPaginateCount));
    }

    /*
     * Сохранение
     */
    public function store(StoreRequest $request,ClientService $clientService):JsonResponse
    {
        $addResult = $clientService->addEvent($request->all());
        if($addResult){
            return response()->json(["error"=>false]);
        }
        return response()->json(["error"=>true,"message"=>implode(',',$clientService->errors)]);
    }

    /*
     * Удаление события
     */
    public function destroy(Request $request,int $id,ClientService $clientService)
    {
        return response()->json(["error"=>!$clientService->deleteEvent($request->user()->id,$id),"message"=>implode(',',$clientService->errors)]);
    }
}
