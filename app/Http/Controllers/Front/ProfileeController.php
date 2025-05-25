<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileeController extends Controller
{
     public function show()
    {
        $user=Auth::user();
         $courses = $user->courses;
        return View('users.frontend.profile.show',compact('user','courses'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.frontend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user=Auth::user();

       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // يمكن تضيف حقول أخرى
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
   
        $user->save();

        return redirect()->route('users.profile.show')->with('success', 'Profile Updated Succefully');
    }
}
