<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\Product;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Get History by Product
     * @param App\Models\Product $product
     * @return JSON
     */
    public function index(Product $product)
    {
        
        // Load History and Location of Product
        $product = $product->load('history.historyable', 'history.rack.warehouse');

        // Sort By History Date
        $history = $product->history->sortBy(function ($history) {
            return Carbon::createFromFormat('d/m/Y', $history->histories->date);
        });

        return HistoryResource::collection($history);
    }
}
