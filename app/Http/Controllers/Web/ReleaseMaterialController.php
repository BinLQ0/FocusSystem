<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReleaseMaterialRequest;
use App\Models\ReleaseMaterial;

class ReleaseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.release-material.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.release-material.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReleaseMaterialRequest $request)
    {
        ReleaseMaterial::create($request->all());

        return redirect()->intended(route('release-material.index'))
            ->with('toast_success', "Create Release Material <b> Lot. '{$request->for}'</b>, Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReleaseMaterial  $releaseMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(ReleaseMaterial $releaseMaterial)
    {
        $product = $releaseMaterial->product;

        return view('pages.release-material.createOrUpdate', compact('releaseMaterial', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReleaseMaterial  $releaseMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(ReleaseMaterialRequest $request, ReleaseMaterial $releaseMaterial)
    {
        $releaseMaterial->update($request->all());

        return redirect()->intended(route('release-material.index'))
            ->with('toast_success', "Create Release Material <b> Lot. '{$request->for}'</b>, Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReleaseMaterial  $releaseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReleaseMaterial $releaseMaterial)
    {
        $releaseMaterial->delete();
    }
}
