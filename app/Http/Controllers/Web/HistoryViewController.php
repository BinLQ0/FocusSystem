<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HistoryViewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product)
    {
        $racks = $product->history
            ->load('rack')
            ->groupBy('rack.code')
            ->mapWithKeys(function ($group, $key) {
                return [
                    $key => $group->calculateStock()
                ];
            });

        return view('pages.history.view', compact('product', 'racks'));
    }
}