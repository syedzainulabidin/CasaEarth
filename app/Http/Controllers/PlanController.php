<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myTier = Auth::user()->tier;
        $tiers = Tier::all();
        // $check = Tier::findorFail($myTier)->price;

        // return [$myTier, $check];

        return view('dashboard.plan.index', compact('tiers', 'myTier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($plan)
    {
        $tier = Tier::where('title', $plan)->first();

        return view('dashboard.plan.upgrade', compact('tier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function upgrade($id)
    {
        return $id;
    }
}
