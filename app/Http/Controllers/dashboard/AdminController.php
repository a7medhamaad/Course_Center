<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', 'user')->with('courses')->get();

        return view('dashboard.admin.index', compact('admins', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('dashboard.admin.create', [
            'user' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . $admin->id,
            // 'password' => 'required|string|min:6',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => bcrypt($request->password),
        ]);

        $admin->courses()->sync($request->courses ?? []);

        return redirect()->route('dashboard.admin.index')
            ->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::findOrFail($id);
        return View('dashboard.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        // $users=User::findOrFail($id);
        $courses=Course::all();
      $userCourses = $admin->courses->pluck('id')->toArray();
        return View('dashboard.admin.edit', compact('admin', 'courses','userCourses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $admin)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $admin->courses()->sync($request->input('courses', []));

        return redirect()->route('dashboard.admin.index')
            ->with('success', 'User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('dashboard.admin.index')
            ->with('success', 'User Deleted Successfully');
    }

    public function coursePurchases()
    {
        $courses = Course::with('users')->get();
        return view('dashboard.admin.course_purchases', compact('courses'));
    }
}
