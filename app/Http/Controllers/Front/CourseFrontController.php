<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Stripe\Charge;
use Stripe\Stripe;

class CourseFrontController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->get();

        $purchasedCourseIds = [];

        if (Auth::check()) {
            $purchasedCourseIds = Auth::user()->courses()->pluck('courses.id')->toArray();
        }

        return view('users.frontend.courses.index', compact('courses', 'purchasedCourseIds'));
    }

    public function show($id)
    {
        $course = Course::with('videos')->findOrFail($id);

        // تأكد أن المستخدم فعلاً مشترك في الكورس
        if (!auth()->user()->courses->contains($course)) {
            abort(403, 'Unauthorized');
        }

        return view('users.frontend.courses.show', compact('course'));
    }

    public function checkout(Course $course)
    {
        return view('users.frontend.courses.checkout', compact('course'));
    }


    public function pay(Request $request, Course $course)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $charge = Charge::create([
                'amount' => $request->price * 100,
                'currency' => 'usd',
                'description' => 'شراء الكورس: ' . $request->course_title,
                'source' => $request->stripeToken,
            ]);

            $user = auth()->user();

            // تحقق إذا المستخدم مش مشترك في الكورس أصلا
            if (!$user->courses->contains($course->id)) {
                // أضف الكورس للمستخدم
                $user->courses()->attach($course->id);

                // سجل عملية الدفع في جدول payments
                Payment::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'amount' => $request->price,
                    'payment_method' => 'stripe',
                    'payment_status' => 'completed', // ممكن تعدل حسب الحالة اللي تريدها
                ]);

                return redirect()->route('users.courses.my')->with('success', 'تم الدفع والاشتراك في الكورس بنجاح!');
            } else {
                return redirect()->route('users.courses.my')->with('error', 'You subscribed to this course before');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء عملية الدفع: ' . $e->getMessage());
        }
    }



    public function showNotifications()
    {
        $notifications = auth()->user()->notifications; // أو unreadNotifications لو عايز بس غير المقروءة
        auth()->user()->unreadNotifications->markAsRead();
        return view('users.frontend.courses.notifications', compact('notifications'));
    }


    public function myCourses()
    {
        $user = auth()->user();

        $courses = $user->courses()->with('videos')->get();

        return view('users.frontend.courses.my', compact('courses'));
    }

    public function destroy(Course $course)
    {
        $user = Auth::user();
        $user->courses()->detach($course->id);

        return redirect()->back()->with('success', 'تم إلغاء الاشتراك في الكورس بنجاح');
    }
}
