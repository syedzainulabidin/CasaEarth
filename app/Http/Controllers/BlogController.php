<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    private function getRole()
    {
        return Auth::user()?->role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Auth::user()->role;
        $blogs = Blog::get();

        return match ($this->getRole()) {
            'admin' => view('dashboard.blog.index', compact('blogs')),
            'user' => redirect()->route('blogs'),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate inputs
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // ✅ Create new blog
        $blog = new Blog;
        $blog->heading = $validated['heading'];
        $blog->content = $validated['content'];
        $blog->save();

        // ✅ Redirect with success message
        return redirect()->route('blog.index')
            ->with('success', 'Blog created successfully!');
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
        $blog = Blog::findOrFail($id); // ✅ fetch the blog by ID

        return view('dashboard.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ✅ Validate inputs
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // ✅ Find blog
        $blog = Blog::findOrFail($id);

        // ✅ Update fields
        $blog->heading = $validated['heading'];
        $blog->content = $validated['content'];
        $blog->save();

        // ✅ Redirect with success message
        return redirect()->route('blog.index')
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ✅ Find blog or fail
        $blog = Blog::findOrFail($id);

        // ✅ Delete it
        $blog->delete();

        // ✅ Redirect with success message
        return redirect()->route('blog.index')
            ->with('success', 'Blog deleted successfully!');
    }

    public function blog(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('blog', compact('blog'));
    }
}
