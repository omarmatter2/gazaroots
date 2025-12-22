<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AssistanceRequestController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WaterProjectController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Dashboard\NavItemController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ArticleController as WebsiteArticleController;
use App\Http\Controllers\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Website\SubscriberController as WebsiteSubscriberController;
use App\Http\Controllers\Website\WaterProjectController as WebsiteWaterProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website (Public) Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Articles
Route::get('/article/{slug}', [WebsiteArticleController::class, 'show'])->name('article.show');

// Newsletter Subscription
Route::post('/subscribe', [WebsiteSubscriberController::class, 'store'])->name('subscribe');

// Category page
Route::get('/category/{slug}', [WebsiteCategoryController::class, 'show'])->name('category.show');

// Water Projects
Route::get('/water', [WebsiteWaterProjectController::class, 'index'])->name('water.index');
Route::get('/water-project/{slug}', [WebsiteWaterProjectController::class, 'show'])->name('water-project.show');

Route::get('/testimonials', function() { return redirect()->route('home'); })->name('testimonials.index');
Route::get('/request-help', function() { return redirect()->route('home'); })->name('request-help');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Protected routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Content Management
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('authors', AuthorController::class);

        // Donations
        Route::resource('water-projects', WaterProjectController::class);
        Route::resource('donations', DonationController::class);

        // Support
        Route::resource('assistance-requests', AssistanceRequestController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('subscribers', SubscriberController::class);

        // Newsletters
        Route::post('newsletters/{newsletter}/send-now', [NewsletterController::class, 'sendNow'])->name('newsletters.send-now');
        Route::resource('newsletters', NewsletterController::class);

        // Navigation Management
        Route::resource('nav-items', NavItemController::class);
    });
});


