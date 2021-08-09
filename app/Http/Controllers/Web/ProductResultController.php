<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductResultRequest;
use App\Models\ProductResult;
use Illuminate\Http\Request;

class ProductResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.product-result.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product-result.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductResultRequest $request)
    {
        ProductResult::create($request->all());

        return redirect()->intended(route('product-result.index'))
            ->with('toast_success', "Product '{$request->description}'<b> Lot. '{$request->lot}'</b>, Finished!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductResult  $productResult
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductResult $productResult)
    {
        $releaseMaterial = $productResult->release;

        $productResult->materialUsed = $releaseMaterial->products->sum('pivot.quantity');

        return view('pages.product-result.createOrUpdate', compact('productResult'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductResult  $productResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductResult $productResult)
    {
        $productResult->update($request->all());

        return redirect()->intended(route('product-result.index'))
            ->with('toast_success', "Product '{$request->description}'<b> Lot. '{$request->lot}'</b>, Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductResult  $productResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductResult $productResult)
    {
        $productResult->delete();
    }
}
