<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Rack;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseRackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function index(Warehouse $warehouse)
    {
        return view('pages.racks.index', compact('warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function create(Warehouse $warehouse)
    {
        return view('pages.racks.createOrUpdate', compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Warehouse $warehouse)
    {
        $warehouse->racks()->create($request->all());

        return redirect()
            ->intended(route('warehouse.racks.index', [
                'warehouse' => $warehouse->id
            ]))
            ->with('toast_success', "Created Rack <b>'{$request->code}'</b>, Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @param  \App\Models\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function edit(Rack $rack)
    {
        // Get Warehouse
        $warehouse = $rack->warehouse;

        return view('pages.racks.createOrUpdate', compact('rack', 'warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @param  \App\Models\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rack $rack)
    {
        // Update Rack
        $rack->update($request->all());

        return redirect()
            ->intended(route('warehouse.racks.index', [
                'warehouse' => $request->warehouse_id
            ]))
            ->with('toast_success', "Update Rack <b>'{$request->code}'</b>, Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @param  \App\Models\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rack $rack)
    {
        $rack->delete();
    }
}
