<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReceiveItem;
use Illuminate\Http\Request;

class ReceiveItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.receive-item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.receive-item.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ReceiveItem::create($request->all());

        return redirect()->intended(route('receive-item.index'))
            ->with('toast_success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiveItem  $receiveItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiveItem $receiveItem)
    {
        return view('pages.receive-item.createOrUpdate', compact('receiveItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiveItem  $receiveItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveItem $receiveItem)
    {
        $receiveItem->update($request->all());

        return redirect()->intended(route('receive-item.index'))
            ->with('toast_success', 'Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiveItem  $receiveItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveItem $receiveItem)
    {
        $receiveItem->delete();
    }
}
