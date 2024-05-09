<?php

use App\Events\GetNews;
use App\Services\HttpRequest\CustomRequest;
use App\Services\news\NewsAPI\NewsApiRepository;
use App\Services\news\NyTimes\NYTimesNewsRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Domain\NYTimes\Http\Controllers\Api\V1\NYTimesController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('news/{id}' , [NYTimesController::class , 'showVue'])
    ->middleware(['web'])
    ->name('news.single');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

