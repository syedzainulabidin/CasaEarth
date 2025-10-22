<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiers = Tier::all();

        return view('dashboard.tier.index', compact('tiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'includes' => 'nullable|array',
            'includes.*' => 'string|max:255',
        ]);

        Tier::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'includes' => $validated['includes'] ?? [],
        ]);

        return redirect()->route('tier.index')->with('success', 'Tier created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tier = Tier::findOrFail($id);

        return view('dashboard.tier.edit', compact('tier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tier = Tier::findOrFail($id);

        // Fix includes handling before validation
        $data = $request->all();
        if (! isset($data['includes'])) {
            $data['includes'] = [];
        } elseif (! is_array($data['includes'])) {
            $data['includes'] = [$data['includes']];
        }

        // Validate input
        $validated = validator($data, [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',
        ])->validate();

        // Encode includes as JSON string to match current storage format
        $includesJson = json_encode($validated['includes'] ?? []);

        // Update tier
        $tier->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'includes' => $includesJson,
        ]);

        return redirect()->route('tier.index')->with('success', 'Tier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tier = Tier::findOrFail($id);
        $tier->delete();

        return redirect()->route('tier.index')->with('success', 'Tier deleted successfully!');
    }
}
