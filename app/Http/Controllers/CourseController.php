<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Module;
use App\Models\Content;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::with('modules.contents')->paginate(2);

        return view('courses.index', compact('courses'));
    }
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'feature_video' => 'nullable|url',
            'description' => 'nullable',
            'category' => 'nullable',
            'modules' => 'nullable|array',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.source_type' => 'required|string',
            'modules.*.contents.*.video_url' => 'nullable|url',
            'modules.*.contents.*.video_length' => 'nullable|string',
        ]);

        $course = Course::create([
            'title' => $validated['title'],
            'feature_video' => $validated['feature_video'] ?? null,
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? null
        ]);


        if ($request->has('modules')) {
            foreach ($request->modules as $moduleData) {
                $module = $course->modules()->create([
                    'title' => $moduleData['title'],
                ]);

                if (!empty($moduleData['contents'])) {
                    foreach ($moduleData['contents'] as $contentData) {
                        $module->contents()->create([
                            'title' => $contentData['title'],
                            'source_type' => $contentData['source_type'],
                            'video_url' => $contentData['video_url'] ?? null,
                            'video_length' => $contentData['video_length'] ?? null,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Course created successfully.');
    }

    public function show($id)
    {
        $course = Course::with('modules.contents')->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
