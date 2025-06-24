<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Career;
use App\Models\CareerForm;
use App\Models\CosultBanner;
use App\Models\CosultDetail;
use App\Models\Page;
use App\Models\Service;
use App\Models\WeOffer;
use App\Models\WhyUs;
use App\Services\CrudService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

     protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Contact';
    }

    public function index()
    {
        $services = Service::where('status', 1)->latest()->get();
        $banner = Banner::where('status',1)->orderBy('priority', 'asc')->latest()->get();
        $cb = CosultBanner::first();
        $consult = CosultDetail::where('status', 1)->latest()->get();
        $offer = WeOffer::where('status', 1)->latest()->get();
        $fb = WhyUs::first();
        return view('frontend.index', compact('services', 'banner', 'cb', 'consult', 'offer', 'fb'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function services(){
        return view('frontend.service');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function storeContact(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'message' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255'
            ]);


            $data = $request->all();
            $this->crudService->create($this->modelName, $data);

            toast('Message Sent!', 'success');
        } catch (\Illuminate\Validation\ValidationException $e) {
            toast("Message isn't sent", 'error');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }


        return redirect()->back();
    }
    public function blog()
    {
        return view('frontend.blog');
    }
    public function blogDetails()
    {
        return view('frontend.blogdetail');
    }
    public function career()
    {
        $career = Career::where('status', 1)->whereDate('end_date', '>=', now()->toDateString())->whereDate('start_date', '<=', now()->toDateString())->where('type_id', 1)->latest()->get();
        return view('frontend.career', compact('career'));
    }
    public function careerDetails($slug)
    {
        $career = Career::where('slug', $slug)->firstOrFail();
        return view('frontend.career-detail', compact('career'));
    }
    public function storeCareer(Request $request)
    {
        try {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email'      => 'required|email|max:255',
            'cv'         => 'required|file|mimes:pdf,doc,docx|max:2048', // max 2MB
            'type_id'    => 'required|exists:types,id',
            'career_id' => 'required|exists:careers,id',
        ]);

        $validated = $request->except('cv');

        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $cv = $request->file('cv');
            $destinationPath = 'uploads/cv/';
            $pdfName = date('ymdHis') . "." . $cv->getClientOriginalExtension();
            $cv->move(public_path($destinationPath), $pdfName);
            $validated['cv'] = $destinationPath . $pdfName;
        }


        // Save data in DB
        CareerForm::create($validated);
        toast('Application submitted successfully!', 'success');
        } catch (\Illuminate\Validation\ValidationException $e) {
            toast("Application submission failed", 'error');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            toast("An error occurred: " . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
    }

        return redirect()->back();
    }
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.page', compact('page'));

    }
}