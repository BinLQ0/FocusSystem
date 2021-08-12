<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $vehicle = Vehicle::query();

        return VehicleResource::collection($vehicle->get());
    }
}
