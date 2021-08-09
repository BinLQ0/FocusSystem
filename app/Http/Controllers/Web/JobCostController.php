<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JobCost;
use App\Models\JobCostReferance;
use Illuminate\Http\Request;

class JobCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.job-cost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.job-cost.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JobCost::create($request->all());

        return redirect()->intended(route('job-cost.index'))
            ->with('toast_success', "Create JobCost, Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobCost  $jobCost
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCost $jobCost)
    {
        return view('pages.job-cost.createOrUpdate', compact('jobCost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCost  $jobCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCost $jobCost)
    {
        $jobCost->update($request->all());

        return redirect()->intended(route('job-cost.index'))
            ->with('toast_success', "Create JobCost, Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobCost  $jobCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCost $jobCost)
    {
        $jobCost->delete();
    }
}
