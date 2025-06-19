<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\ConfigurationController;
use App\Http\Controllers\Dashboard\ConsultBannerController;
use App\Http\Controllers\Dashboard\ConsultDetailController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ServiceCategoryController;
use App\Http\Controllers\Dashboard\WeOfferController;
use App\Http\Controllers\Dashboard\WhyUsBannerController;
use App\Http\Controllers\Dashboard\WhyUsController;
use App\Http\Controllers\Dashboard\WhyUsDetailController;
use App\Http\Controllers\FrontendController;
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
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    //index
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('/update-account', [DashboardController::class, 'account'])->name('update-account');
    Route::post('/update-profile', [DashboardController::class, 'update'])->name('profile.update');

    //banner
    Route::resource('/banner', BannerController::class);
    Route::post('/banner/{id}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banner.toggle-status');

    //consult-banner
    Route::get('/consult-banner', [ConsultBannerController::class, 'index'])->name('consult-banner.index');
    Route::post('/consult-banner/update', [ConsultBannerController::class, 'update'])->name('consult-banner.update');

    //consult-detail
    Route::resource('/consult-detail', ConsultDetailController::class);
    Route::post('/consult-detail/{id}/toggle-status', [ConsultDetailController::class, 'toggleStatus'])->name('consult-detail.toggle-status');

    //offer
    Route::resource('/offer', WeOfferController::class);
    Route::post('/offer/{id}/toggle-status', [WeOfferController::class, 'toggleStatus'])->name('offer.toggle-status');

    //why-us banner 
    Route::get('/why-us-banner', [WhyUsBannerController::class, 'index'])->name('why-us-banner.index');
    Route::post('/why-us-banner/update', [WhyUsBannerController::class, 'update'])->name('why-us-banner.update');

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
});
