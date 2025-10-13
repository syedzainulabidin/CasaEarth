<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    // * <-- CUSTOM * MIDDLEWARES --> *
    private function getRole()
    {
        return Auth::user()?->role;
    }

    public function index()
    {
        $therapists = Therapist::get();

        return match ($this->getRole()) {
            'admin' => view('dashboard.therapist.admin.index', compact('therapists')),
            'user' => view('dashboard.therapist.user.index', compact('therapists')),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.therapist.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if($this->getRole() = 'user')
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:therapists,email',
            'specialization' => 'required|string|max:255',
            'slots' => 'nullable|array',
            'slots.*' => 'string',
            'days' => 'nullable|array',
            'days.*' => 'string',
            'charges' => 'required|numeric',

        ]);

        // ✅ Create new therapist
        $therapist = new Therapist;
        $therapist->name = $validated['name'];
        $therapist->email = $validated['email'];
        $therapist->specialization = $validated['specialization'];
        $therapist->slots = json_encode($validated['slots'] ?? []);
        $therapist->days = json_encode($validated['days'] ?? []);
        $therapist->charges = $validated['charges'];

        $therapist->save();

        // ✅ Redirect back with success message
        return redirect()->route('therapist.index')
            ->with('success', 'Therapist added successfully!');
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
        $therapist = Therapist::findorFail($id);

        return view('dashboard.therapist.admin.edit', compact('therapist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ✅ Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:therapists,email,'.$id, // ignore current email
            'specialization' => 'required|string|max:100',
            'slots' => 'required|array|min:1',
            'slots.*' => 'required|string',
            'days' => 'required|array|min:1',
            'days.*' => 'required|string',
            'charges' => 'required|numeric',
        ]);

        // ✅ Find therapist
        $therapist = Therapist::findOrFail($id);

        // ✅ Update fields
        $therapist->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'specialization' => $validated['specialization'],
            'slots' => json_encode($validated['slots']),
            'days' => json_encode($validated['days']),
            'charges' => $validated['charges'],

        ]);

        // ✅ Redirect back
        return redirect()
            ->route('therapist.index')
            ->with('success', 'Therapist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $therapist = Therapist::findOrFail($id);
        $therapist->delete();

        return redirect()
            ->route('therapist.index')
            ->with('success', 'Therapist deleted successfully!');
    }
}
