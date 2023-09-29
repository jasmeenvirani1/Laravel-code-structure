<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\BillingController;
use App\Http\Controllers\frontend\ExploreFitnessController;
use App\Http\Controllers\frontend\FeedbackController;
use App\Http\Controllers\frontend\FrontController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\frontend\MatchController;
use App\Http\Controllers\frontend\PageController;
use App\Http\Controllers\frontend\PricingController;
use App\Http\Controllers\frontend\ProfileController;

/*
|--------------------------------------------------------------------------
| Front Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return redirect()->route('front.login');
});

Route::get('/', [LoginController::class, 'View'])->name('front.home');
Route::get('login', [LoginController::class, 'View'])->name('front.login');
Route::post('login', [LoginController::class, 'PostLogin'])->name('front.post-login');

Route::get('pricing', [PricingController::class, 'Index'])->name('front.pricing');
Route::get('create-account/{id?}', [LoginController::class, 'CreateAccount'])->name('front.create-account');
Route::post('create-account', [LoginController::class, 'PostCreateAccount'])->name('front.post-create-account');
Route::post('create-free-provider-account', [LoginController::class, 'FreeProviderSingUp'])->name('front.post-create-provider-account');

Route::get('billing', [BillingController::class, 'Index'])->name('front.bill');
Route::post('payment', [BillingController::class, 'Payment'])->name('front.payment');

Route::get('/pages/{slug}', [PageController::class, 'Index'])->name('front.get-pages');
Route::get('support', [FrontController::class, 'GetSupport'])->name('front.support');

Route::post('seeker-singup', [LoginController::class, 'SeekerSingup'])->name('front.seeker.singup');

Route::get('feedback', [FeedbackController::class, 'index'])->name('front.get-feedback');
Route::post('store-feedback', [FeedbackController::class, 'Store'])->name('front.store-feedback');

Route::middleware('UserSession')->group(function () {
    Route::get('match', [MatchController::class, 'Index'])->name('front.match');
    Route::post('match/add', [MatchController::class, 'AddMatch'])->name('front.match.add');
    Route::get('explore-fitness', [ExploreFitnessController::class, 'Index'])->name('front.explore-fitness');
    Route::post('get-keyword', [ExploreFitnessController::class, 'Getkeyword'])->name('get.keyword');
    Route::post('get-provider-citys', [ExploreFitnessController::class, 'GetProviderCitys'])->name('get.provider-citys');
    Route::post('add-favourite-provider', [ExploreFitnessController::class, 'AddFavouriteProvider'])->name('front.add.favourite.provider');
    // Route::get('get-seeker-profile', [ProfileController::class, 'GetSeekerProfile'])->name('front.get-seeker-profile');
});
Route::get('get-profile/{id}', [ProfileController::class, 'GetProfile'])->name('front.get-profile');

Route::get('forget-password', [ForgetController::class, 'Index'])->name('front.forget-password');
Route::post('validate-email-forget-password', [ForgetController::class, 'CheckEmail'])->name('front.check-email-forget-password');

Route::get('forget-password-email/{token}', [ForgetController::class, 'GetForgetPassword'])->name('front.get-email-forget-password-form');