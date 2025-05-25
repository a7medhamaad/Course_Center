<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use App\Notifications\VideoAdded;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string',
            'video' => 'required|file|mimes:mp4,mov,avi,webm|max:20000',
        ]);

        $path = $request->file('video')->store('video', 'public');
        $video = Video::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'video_path' => $path,
        ]);

        $course = Course::find($request->course_id);
        $users = $course->users;

        foreach ($users as $user) {
            $user->notify(new VideoAdded($course, $video));
        }

        return response()->json([
            'message' => 'Video uploaded successfully',
            'video_url' => asset('storage/' . $video->video_path),
            'video' => $video
        ]);
    }
}
