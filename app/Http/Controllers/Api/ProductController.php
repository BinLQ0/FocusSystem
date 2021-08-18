<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $products = Product::query();

        // Check if request has 'search' text
        $products = $products->when(request()->has('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        });

        // Check if request has 'search' text
        $products = $products->when(request()->has('type'), function ($q) {
            $q->ofType(request('type'));
        });

         // Check if request has 'search' text
         $products = $products->when(request()->has('limit'), function ($q) {
            $q->limit(request('limit'));
        });

        // Relation & Order
        $products = $products->with('history')->orderBy('name');

        return ProductResource::collection($products->get());
    }
}
