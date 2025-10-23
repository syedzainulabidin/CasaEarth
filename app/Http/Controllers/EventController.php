<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tier;
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

        // return $events->tier;

        return match ($this->getRole()) {
            'admin' => view('dashboard.event.admin.index', compact('events')),
            'user' => view('dashboard.event.user.index', compact('myevents')),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiers = Tier::all();

        return view('dashboard.event.admin.create', compact('tiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date_time' => 'required|date',
            'tier' => 'required|exists:tiers,id',
            'event_link' => 'required|url',
        ]);

        // Create a new event with validated data
        Event::create([
            'title' => $validated['event_title'],
            'description' => $validated['event_description'],
            'date_time' => $validated['event_date_time'],
            'tier_id' => $validated['tier'],
            'link' => $validated['event_link'],
        ]);

        // Redirect back to event index with a success message
        return redirect()->route('event.index')->with('success', 'Event created successfully!');
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
        $event = Event::findorFail($id);
        $tiers = Tier::get();

        // return $event;

        return view('dashboard.event.admin.edit', compact('event', 'tiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date_time' => 'required|date',
            'tier' => 'required|exists:tiers,id',
            'event_link' => 'required|url',
        ]);

        // Find the event by ID or fail with 404
        $event = Event::findOrFail($id);

        // Update the event attributes
        $event->title = $validated['event_title'];
        $event->description = $validated['event_description'];
        $event->date_time = $validated['event_date_time'];
        $event->tier_id = $validated['tier'];
        $event->link = $validated['event_link'];

        // Save changes to the database
        $event->save();

        // Redirect back to the event index or show page with success message
        return redirect()->route('event.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the event by ID or fail with 404
        $event = Event::findOrFail($id);

        // Delete the event
        $event->delete();

        // Redirect back to the event index with a success message
        return redirect()->route('event.index')->with('success', 'Event deleted successfully!');
    }
}
