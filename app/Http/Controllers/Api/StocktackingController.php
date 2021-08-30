<?php

namespace App\Http\Controllers\Api;

use App\Exports\StockExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StocktackingController extends Controller
{
    /**
     * Export Stock to Excel on specific days.
     */
    public function exportToExcel()
    {
        $date = request()->has('date') ? Carbon::createFromFormat('d/m/Y', request('date')) : now();
        return (new StockExport($date))->download('Stock-' . $date->format('Ymd') . '.xlsx');
    }
}
