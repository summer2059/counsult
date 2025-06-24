<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\EnquiryMessage;
use App\Models\Financial;
use App\Models\Media;
use App\Models\Message;
use App\Models\Propertie;
use App\Models\Testimonial;
use App\Models\WhyusDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $contactCount = Contact::count(); 
        $enquiryMessageCount = EnquiryMessage::count(); 
        $testimonialCount = Testimonial::count();
        return view('dashboard.index', compact('contactCount', 'enquiryMessageCount', 'testimonialCount'));
    }

    public function account()
    {
        return view('dashboard.user-account.form');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Update the password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            // Log out the user
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            toast('Password updated. Please log in again.');

            // Redirect to login page
            return redirect('/login');
        }
        // Save the updated user details
        toast('Profile updated successfully!');
        $user->save();

        // Redirect with a success message
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }
}
