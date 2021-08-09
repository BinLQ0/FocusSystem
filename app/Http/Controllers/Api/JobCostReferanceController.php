<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobCostReferance;

class JobCostReferanceController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $referance = JobCostReferance::query();

        return $referance->orderBy('name')->get();
    }
}
