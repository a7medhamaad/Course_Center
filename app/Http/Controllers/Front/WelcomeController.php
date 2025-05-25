<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->get();

        return view('welcome2', compact('courses'));
    }
}
