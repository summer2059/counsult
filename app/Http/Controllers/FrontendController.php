<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Career;
use App\Models\CareerForm;
use App\Models\CosultBanner;
use App\Models\CosultDetail;
use App\Models\FAQs;
use App\Models\Message;
use App\Models\MisionBanner;
use App\Models\Mission;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\TestimonialBanner;
use App\Models\Vision;
use App\Models\VisionBanner;
use App\Models\WeOffer;
use App\Models\WhyUs;
use App\Models\WhyUsDetail;
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
        $banner = Banner::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        $cb = CosultBanner::first();
        $consult = CosultDetail::where('status', 1)->where('type_id', 1)->latest()->get();
        $offer = WeOffer::where('status', 1)->latest()->get();
        $fb = WhyUs::first();
        $vb = VisionBanner::first();
        $vision = Vision::where('status', 1)->where('type_id', 1)->latest()->get();
        $mb = MisionBanner::first();
        $mission = Mission::where('status', 1)->where('type_id', 1)->latest()->get();
        $message = Message::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        $tb = TestimonialBanner::first();
        $testimonial = Testimonial::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        $team = Team::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        $whyDetail = WhyUsDetail::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        return view('frontend.index', compact('services', 'banner', 'cb', 'consult', 'offer', 'fb', 'vb', 'vision', 'mb', 'mission', 'message', 'tb', 'testimonial', 'team', 'whyDetail'));
    }
    public function about()
    {
        $services = Service::where('status', 1)->latest()->get();
        $banner = Banner::where('status', 1)->orderBy('priority', 'asc')->latest()->get();
        $cb = CosultBanner::first();
        $consult = CosultDetail::where('status', 1)->latest()->get();
        $offer = WeOffer::where('status', 1)->latest()->get();
        $fb = WhyUs::first();
        return view('frontend.about', compact('services', 'banner', 'cb', 'consult', 'offer', 'fb'));
    }
    public function services()
    {
        $service = ServiceCategory::where('status', 1)->where('type_id', 1)->orderBy('priority', 'asc')->latest()->get();
        $services = Service::where('status', 1)->latest()->get();
        return view('frontend.service', compact('service', 'services'));
    }
    public function serviceDetail($slug)
    {
        $category = ServiceCategory::where('slug', $slug)->where('status', 1)->where('type_id', 1)->firstOrFail();
        $relatedServices = Service::where('service_category_id', $category->id)
            ->where('status', 1)
            ->where('type_id', 1)
            ->get();
        $hasMenu = $relatedServices->whereNotNull('price')->count() > 0;

        return view('frontend.service-detail', compact('category', 'relatedServices', 'hasMenu'));
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
    public function blog(Request $request)
    {
        $query = Blog::with('blogCategory')
            ->where('status', 1)
            ->where('type', 'english');

        if ($request->filled('category')) {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        $blogs = $query->latest()->paginate(6);
        $categories = BlogCategory::where('status', 1)->get();

        return view('frontend.blog', compact('blogs', 'categories'));
    }

    // AJAX-based blog search
    public function searchBlog(Request $request)
    {
        $query = Blog::with('blogCategory')
            ->where('status', 1)
            ->where('type', 'english');

        if ($request->filled('category')) {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        $blogs = $query->latest()->paginate(6);
        return view('frontend.partials.blog-list', compact('blogs'))->render();
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->where('type', 'english')->firstOrFail();

        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->where('status', 1)
            ->where('type', 'english')
            ->latest()
            ->take(5)
            ->get();

        $categories = BlogCategory::where('status', 1)->get();

        return view('frontend.blogdetail', compact('blog', 'recentBlogs', 'categories'));
    }
    public function searchBlogJson(Request $request)
    {
        $query = Blog::where('status', 1)
            ->where('type', 'english');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $results = $query->select('title', 'slug')->take(10)->get();

        return response()->json($results);
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
    public function faqs()
    {
        $faqs = FAQs::where('status', 1)->where('type_id', 1)->latest()->get();
        return view('frontend.faqs', compact('faqs'));
    }

    public function gallery()
    {
        return view('frontend.gallery');
    }
}
