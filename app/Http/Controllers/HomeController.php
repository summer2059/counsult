<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\EnquiryMessage;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contactCount = Contact::count();
        $enquiryMessageCount = EnquiryMessage::count();
        $testimonialCount = Testimonial::count();
        return view('dashboard.index', compact('contactCount', 'enquiryMessageCount', 'testimonialCount'));
    }
}
