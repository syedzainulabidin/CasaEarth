<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Myguide;
use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    private function getRole()
    {
        return Auth::user()?->role;
    }

    public function index()
    {
        $user = Auth::user();
        $role = $this->getRole();

        // Admin sees all
        if ($role === 'admin') {
            $guides = Guide::all();

            return view('dashboard.guides.admin.index', compact('guides'));
        }

        // User: filter guides based on user's tier
        if ($role === 'user') {
            $userTier = $user->tier;

            $guides = Guide::where(function ($query) use ($userTier) {
                if ($userTier === 'free') {
                    $query->where('tier', 'free');
                } elseif ($userTier === 'premium') {
                    $query->whereIn('tier', ['free', 'premium']);
                } elseif ($userTier === 'advance') {
                    $query->whereIn('tier', ['free', 'premium', 'advance']);
                }
            })->get();

            return view('dashboard.guides.user.index', compact('guides'));
        }

        // Other roles are not allowed
        abort(403, 'Unauthorized access.');
    }

    public function download(Guide $guide)
    {
        $user = Auth::user();

        // Allow admin to download regardless of guide tier
        if ($user->role === 'admin') {
            if (! Storage::disk('public')->exists($guide->file_path)) {
                abort(404, 'File not found.');
            }

            return Storage::disk('public')->download($guide->file_path);
        }

        $userTier = strtolower($user->tier->title);

        // Determine if user has access based on guide's tier
        $canDownload = match ($guide->tier) {
            'free' => in_array($userTier, ['free', 'premium', 'advance']),
            'premium' => in_array($userTier, ['premium', 'advance']),
            'advance' => $userTier === 'advance',
            default => false,
        };

        if (! $canDownload) {
            abort(403, 'You are not authorized to access this guide.');
        }

        if (! Storage::disk('public')->exists($guide->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($guide->file_path);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.guides.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tier' => 'required|in:free,premium,advance',
            'file' => 'required|mimes:pdf|max:20480', // 20 MB
        ]);

        // 2. Temporarily create the guide without file_path to get the ID
        $guide = Guide::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'tier' => $validated['tier'],
            'file_path' => '', // placeholder
        ]);

        // 3. Generate the custom filename using the guide ID
        $extension = $request->file('file')->getClientOriginalExtension(); // should be 'pdf'
        $filename = 'CasaEarthGuide-'.$guide->id.'.'.$extension;

        // 4. Store the file using the custom name
        $filePath = $request->file('file')->storeAs('guides', $filename, 'public');

        // 5. Update the guide with the correct file path
        $guide->update([
            'file_path' => $filePath,
        ]);

        return redirect()->route('guide.index')->with('success', 'Guide uploaded successfully!');
    }

    public function view(Guide $guide)
    {
        $user = Auth::user();

        // Allow admin to view regardless of guide tier
        if ($user->role === 'admin') {
            $path = storage_path('app/public/'.$guide->file_path);

            if (! file_exists($path)) {
                abort(404, 'File not found.');
            }

            return response()->file($path, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.basename($path).'"',
            ]);
        }

        $userTier = strtolower($user->tier->title);

        // Determine if user has access based on guide's tier
        $canView = match ($guide->tier) {
            'free' => in_array($userTier, ['free', 'premium', 'advance']),
            'premium' => in_array($userTier, ['premium', 'advance']),
            'advance' => $userTier === 'advance',
            default => false,
        };

        if (! $canView) {
            abort(403, 'You are not authorized to view this guide.');
        }

        $path = storage_path('app/public/'.$guide->file_path);

        if (! file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.basename($path).'"',
        ]);
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
    public function edit(Guide $guide)
    {
        $tiers = Tier::get();

        return view('dashboard.guides.admin.edit', compact('guide', 'tiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guide = Guide::findOrFail($id);

        $validated = $request->validate([
            'guide_title' => 'required|string|max:255',
            'guide_description' => 'required|string',
            'tier' => 'required|in:free,premium,advance',
            'file' => 'nullable|mimes:pdf|max:20480',
        ]);

        $data = [
            'title' => $validated['guide_title'],
            'description' => $validated['guide_description'],
            'tier' => $validated['tier'],
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($guide->file_path && Storage::disk('public')->exists($guide->file_path)) {
                Storage::disk('public')->delete($guide->file_path);
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = 'CasaEarthGuide-'.$guide->id.'.'.$extension;
            $filePath = $request->file('file')->storeAs('guides', $filename, 'public');
            $data['file_path'] = $filePath;
        }

        $guide->update($data);

        return redirect()->route('guide.index')->with('success', 'Guide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guide = Guide::findOrFail($id);

        if ($guide->file_path && Storage::disk('public')->exists($guide->file_path)) {
            Storage::disk('public')->delete($guide->file_path);
        }

        $guide->delete();

        return redirect()->route('guide.index')->with('success', 'Guide deleted successfully.');
    }

    public function add(Guide $guide)
    {
        $user = Auth::user();
        $userTier = strtolower($user->tier->title);

        // Determine if user has access based on guide's tier
        $canAdd = match ($guide->tier) {
            'free' => in_array($userTier, ['free', 'premium', 'advance']),
            'premium' => in_array($userTier, ['premium', 'advance']),
            'advance' => $userTier === 'advance',
            default => false,
        };

        if (! $canAdd) {
            abort(403, 'You are not authorized to view this guide.');
        }

        $guideAdded = Myguide::create([
            'user_id' => Auth::user()->id,
            'guide_id' => $guide->id,
        ]);

        if ($guideAdded) {
            return redirect()->back()->with('success', 'Guide updated successfully.');
        }
    }

    public function myguides()
    {
        $guides = Auth::user()->guides()->get();

        return view('dashboard.guides.user.myguides', compact('guides'));

    }

    public function remove(Guide $guide)
    {
        Myguide::where('guide_id', $guide->id)
            ->where('user_id', Auth::id()) // Ensures only the current user's guide is removed
            ->delete();

        return redirect()->back()->with('success', 'Guide removed successfully.');
    }
}
