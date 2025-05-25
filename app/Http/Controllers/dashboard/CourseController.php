<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        $courses = $query->get();
    
        return view('dashboard.admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return View('dashboard.admin.courses.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        Course::create($request->all());
        return redirect()->route('dashboard.courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $courses=Course::FindOrFail($id);
        return View('dashboard.admin.courses.show',compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        // $courses=Course::FindOrFail($id);
        $categories=Category::all();
        return View('dashboard.admin.courses.edit',compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());
        return redirect()->route('dashboard.courses.index')
        ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::destroy($id);
        return redirect()->route('dashboard.courses.index')
        ->with('success', 'Course deleted successfully!');
    }

     public function myCourses(Request $request)
    {
        $user = $request->user();

        // مثال جلب الكورسات المرتبطة بالمستخدم (لو العلاقة موجودة)
        $courses = $user->courses; // لازم تكون العلاقة معرفة في موديل User

        return response()->json([
            'courses' => $courses
        ]);
    }

    
}
