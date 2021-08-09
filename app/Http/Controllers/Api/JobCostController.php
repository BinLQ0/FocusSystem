<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobCost;

class JobCostController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $jobcost = JobCost::query();

        // Check range of date default for 3 month ago
        $jobcost = $jobcost->when(request()->has('startDate') && request()->has('endDate'), function ($q) {
            $start  = Carbon::createFromFormat('d/m/Y', request('startDate'));
            $end    = Carbon::createFromFormat('d/m/Y', request('endDate'));

            $q->whereBetween('date', [
                Carbon::parse($start), Carbon::parse($end)
            ]);
        });

        return $jobcost->with('references')
            ->orderBy('date')
            ->get();;
    }
}
