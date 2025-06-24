<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CareerController;
use App\Http\Controllers\Dashboard\CareerFormController;
use App\Http\Controllers\Dashboard\ConfigurationController;
use App\Http\Controllers\Dashboard\ConsultBannerController;
use App\Http\Controllers\Dashboard\ConsultDetailController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EnquiryBannerController;
use App\Http\Controllers\Dashboard\EnquiryMessageController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\QuickLinksController;
use App\Http\Controllers\Dashboard\ServiceCategoryController;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\Dashboard\TestimonialBannerController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\WeOfferController;
use App\Http\Controllers\Dashboard\WhyUsBannerController;
use App\Http\Controllers\Dashboard\WhyUsController;
use App\Http\Controllers\Dashboard\WhyUsDetailController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JapanController;
use App\Http\Controllers\NepaliController;
use App\Models\CareerForm;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home-page');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('store/contact',  'storeContact')->name('store.contact');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blogdetail', 'blogDetails')->name('blogdetail');
    Route::get('/career', 'career')->name('career');
    Route::get('/career-detail/{slug}', 'careerDetails')->name('career-detail');
    Route::post('/store/career', 'storeCareer')->name('store.career');
    Route::get('/page/{slug}', 'page')->name('page');
});

Route::controller(EnquiryMessageController::class)->group(function(){
    Route::post('/enquiry-message/store', 'store')->name('store.enquiry-message');
});

Route::controller(NepaliController::class)->group(function () {
    Route::get('/np', 'np_index')->name('np.index');
});

Route::controller(JapanController::class)->group(function () {
    Route::get('/jp', 'jp_index')->name('jp.index');
    Route::get('/jp/about', 'about')->name('jp.about');
    Route::get('/jp/services', 'services')->name('jp.services');
    Route::get('/jp/contact', 'contact')->name('jp.contact');
    Route::post('/jp/store/contact',  'storeContact')->name('jp.store.contact');
    Route::get('/jp/blog', 'blog')->name('jp.blog');
    Route::get('/jp/blogdetail', 'blogDetails')->name('jp.blogdetail');
    Route::get('/jp/career', 'career')->name('jp.career');
    Route::get('/jp/career-detail/{slug}', 'careerDetails')->name('jp.career-detail');
    Route::post('/jp/store/career', 'storeCareer')->name('jp.store.career');
    Route::get('/jp/page/{slug}', 'page')->name('jp.page');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    //index
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('/update-account', [DashboardController::class, 'account'])->name('update-account');
    Route::post('/update-profile', [DashboardController::class, 'update'])->name('profile.update');
    //banner
    Route::resource('/banner', BannerController::class);
    //consult-banner
    Route::get('/consult-banner', [ConsultBannerController::class, 'index'])->name('consult-banner.index');
    Route::post('/consult-banner/update', [ConsultBannerController::class, 'update'])->name('consult-banner.update');
    Route::get('/enquiry-banner', [EnquiryBannerController::class,'index'])->name('enquiry-banner.index');
    Route::post('/enquiry-banner/update', [EnquiryBannerController::class, 'update'])->name('enquiry-banner.update');
    //why-us
    //consult-detail
    Route::resource('/consult-detail', ConsultDetailController::class);
    //offer
    Route::resource('/offer', WeOfferController::class);
    //why-us banner 
    Route::get('/why-us-banner', [WhyUsBannerController::class, 'index'])->name('why-us-banner.index');
    Route::post('/why-us-banner/update', [WhyUsBannerController::class, 'update'])->name('why-us-banner.update');
    Route::get('/testimonial-banner', [TestimonialBannerController::class, 'index'])->name('testimonial-banner.index');
    Route::post('/testimonial-banner/update', [TestimonialBannerController::class, 'update'])->name('testimonial-banner.update');
    //contact 
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/site-settings', [ConfigurationController::class, 'getConfiguration'])->name('settings');
    Route::post('/site-settings', [ConfigurationController::class, 'postConfiguration'])->name('settings.update');
    //toggle status
    Route::post('/toggle-status/{model}/{id}', [CommonController::class, 'toggleStatus'])->name('toggle-status');
    //why-us detail
    Route::resource('/whyus-detail', WhyUsDetailController::class);
    //service category
    Route::resource('/service-category', ServiceCategoryController::class);
    Route::resource('/services', ServicesController::class);
    Route::resource('/testimoinal', TestimonialController::class);
    Route::resource('/team', TeamController::class);
    Route::resource('/quick-links', QuickLinksController::class);
    Route::resource('/enquiry-message', EnquiryMessageController::class);
    Route::resource('/blog-category', BlogCategoryController::class);
    Route::resource('/blog', BlogController::class);
    Route::resource('/career', CareerController::class);
    Route::resource('/career-form', CareerFormController::class);
    Route::resource('/page', PageController::class);
});
