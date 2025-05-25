<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::all());
    }

    public function show($id)
    {
        $course=Course::with('videos')->findOrFail($id);
        return response()->json($course);
    }

    public function myCourses(Request $request)
    {
        return response()->json($request->user()->courses);
    }

    public function buy(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $request->user()->courses()->attach($course->id);
        return response()->json(['message' => 'Course bought successfully.']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'video_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course = Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'video_url' => $validated['video_url'] ?? null,
            'category_id' => $validated['category_id'],
        ]);

        return response()->json([
            'message' => 'Course created successfully.',
            'course' => $course
        ], 201);
    }

    public function destroy($id)
    {
        $user = auth()->user();

        // السماح فقط للأدمن
        if ($user->role != "admin") {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }
        $course = Course::findOrFail($id);
        if (!$course) {
            return response()->json(['message' => 'course not found'], 404);
        }

        $course->delete();
        return response()->json(['message' => 'course soft-deleted successfully']);
    }

    public function restore($id)
    {
        $user = auth()->user();
        if ($user->role != "admin") {
            return response()->json(['message' => 'Admin only CAn Restore'], 403);
        }

        $course = Course::withTrashed()->FindOrFail($id);

        if (!$course) {
            return response()->json(['message' => 'course Not Found'], 404);
        }

        if (!$course->trashed()) {
            return response()->json(['message' => 'Course is not deleted'], 400);
        }

        $course->restore();

        return response()->json(['message' => 'Course restored successfully']);
    }

    public function trashed()
    {
        $user = auth()->user();

        if ($user->role != "admin") {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }
        $courses = Course::onlyTrashed()->get();
        return response()->json([
            'trashed_courses' => $courses,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($user->role != "admin") {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }

        $course = Course::FindOrFail($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'video_url' => 'sometimes|url',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $course->update($request->only(['title', 'description', 'price', 'video_url', 'category_id']));

        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $course
        ]);
    }
}
