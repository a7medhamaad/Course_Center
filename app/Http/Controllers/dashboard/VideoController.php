<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $courses = Course::with('videos')->get(); // علاقة videos في الموديل Course

        // return view('dashboard.videos.index', compact('courses'));
        return view('dashboard.admin.videos.index', compact('courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('dashboard.admin.videos.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000'
        ]);

        $path = $request->file('video')->store('video', 'public');

        Video::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'video_path' => $path,
        ]);

        return redirect()->route('dashboard.video')->with('success', 'Video Added');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if (Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->delete();

        return redirect()->back()->with('success', 'Video Deleted');
    }
}
