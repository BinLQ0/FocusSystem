<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RackResource;
use App\Models\Rack;

class RackController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $racks = Rack::query();

        // Get by ID
        $racks = $racks->when(request()->has('id'), function ($q) {
            return $q->where('id', request('id'));
        });

        // Get by Warehouse ID
        $racks = $racks->when(request()->has('warehouse'), function ($q) {
            return $q->where('warehouse_id', request('warehouse'));
        });

        // Get by Product ID
        $racks = $racks->when(request()->has('product'), function ($q) {
            return $q->filterHistory('product_id', request('product'));
        });

        return RackResource::collection($racks->with('warehouse')->orderBy('code')->get());
    }
}