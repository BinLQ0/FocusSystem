<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReleaseMaterialResource;
use App\Models\ReleaseMaterial;
use Carbon\Carbon;

class ReleaseMaterialController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // Convert to query
        $release = ReleaseMaterial::query();

        // Check if request has 'search' text
        $release = $release->when(request()->has('search'), function ($q) {
            $q->where('lot', 'like', '%' . request('search') . '%');
        });

        // Check if request has 'status' ('all', 'processing', 'closed')
        $release = $release->when(request()->has('status'), function ($q) {
            if (request('status') === null || request('status') === 'all') return;

            if (request('status') === 'processing') $q->doesntHave('result');
            else $q->has('result');
        });

        //Check if request has 'total'
        $release = $release->when(request()->has('total'), function ($q) {
            if (request('total')) $q->with('products');
        });

        // Check range of date default for 3 month ago
        $release = $release->when(request()->has('startDate') && request()->has('endDate'), function ($q) {
            $start  = Carbon::createFromFormat('d/m/Y', request('startDate'));
            $end    = Carbon::createFromFormat('d/m/Y', request('endDate'));

            $q->whereBetween('date', [
                Carbon::parse($start), Carbon::parse($end)
            ]);
        });

        $release = $release
            ->with('product', 'result')
            ->orderBy('lot')
            ->get();

        return ReleaseMaterialResource::collection($release);
    }
}
