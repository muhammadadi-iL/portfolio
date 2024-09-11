<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\NewsAreaController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/client', [ClientController::class, 'client'])->name('front.client');
Route::get('/contact', [ContactController::class, 'contact'])->name('front.contact');
Route::post('/contact-form', [ContactController::class, 'contactForm'])->name('contact.form');
Route::get('/news-area', [NewsAreaController::class, 'newsArea'])->name('front.news.area');
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('front.portfolio');
Route::get('/pricing', [PricingController::class, 'pricing'])->name('front.pricing');
Route::get('/resume', [ResumeController::class, 'resume'])->name('front.resume');
Route::get('/feature', [ServiceController::class, 'feature'])->name('front.feature');
Route::get('/testimonial', [TestimonialController::class, 'testimonial'])->name('front.testimonial');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

