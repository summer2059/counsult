<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\CosultBanner;
use App\Models\CosultDetail;
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
}
