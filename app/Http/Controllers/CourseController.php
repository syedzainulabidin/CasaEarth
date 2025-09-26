<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
        $courses = Course::get();

        return match ($this->getRole()) {
            'admin' => view('dashboard.course.admin.index', compact('courses')),
            'user' => view('dashboard.course.user.index'),
            default => abort(403, 'Unauthorized access.'),
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.course.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:courses,title',
            'link' => [
                'required',
                'string',
                'max:255',
                // Accepts youtube.com/watch?v=VIDEOID and youtu.be/VIDEOID (allows extra query params)
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]{11}(&.*)?$/i',
                'unique:courses,link',
            ],
            'description' => 'required|string',
            'tier' => 'required|in:intro,all,free,premium,advance',
        ], [
            'title.unique' => 'This course title already exists.',
            'link.unique' => 'This YouTube link is already saved.',
            'link.regex' => 'The link must be a valid YouTube video URL (youtube.com/watch?v=... or youtu.be/...).',
        ]);

        Course::create($validated);

        return redirect()->route('course.index')
            ->with('success', 'Course created successfully.');
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
        $course = Course::findorFail($id);

        return view('dashboard.course.admin.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,'.$course->id,
            'link' => [
                'required',
                'url',
                'unique:courses,link,'.$course->id,
                'regex:~^(https?://)?(www\.)?(youtube\.com/watch\?v=|youtu\.be/)[\w-]{11}~',
            ],
            'description' => 'required|string',
            'tier' => 'required|in:intro,all,free,premium,advance',
        ], [
            'title.unique' => 'This course title already exists.',
            'link.unique' => 'This YouTube link is already used for another course.',
            'link.regex' => 'The URL must be a valid YouTube link.',
        ]);

        $course->update([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            'tier' => $request->tier,
        ]);

        return redirect()->route('course.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('course.index')
            ->with('success', 'Course deleted successfully!');
    }
}
