<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    private function getRole()
    {
        return Auth::user()?->role;
    }

    public function index()
    {
        $events = Event::get();
        $myevents = Event::where('tier_id', Auth::user()->tier->id)->get();
        // return $myevents;
        return match ($this->getRole()) {
            'admin' => view('dashboard.events.admin.index', compact('events')),
            'user' => view('dashboard.events.user.index', compact('myevents')),
            default => abort(403, 'Unauthorized access.'),
        };
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
    public function show(string $id)
    {
        //
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
}
