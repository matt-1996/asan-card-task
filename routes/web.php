<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('run', function(){
   \App\Jobs\GetTopStories::dispatch();

//    $response = Http::withOptions([
//        'proxy' => 'http://127.0.0.1:2081',
//    ])
//        ->withHeaders([
//            'Accept' => 'application/json'
//        ])
//        ->get("https://api.nytimes.com/svc/topstories/v2/fashion.json?api-key=hviszdbnsT450nmR2KgODGg97mwsOcWx");
//
//        $res = $response->json();

//    $res = Http::getWithProxy('https://api.nytimes.com/svc/topstories/v2/fashion.json?api-key=hviszdbnsT450nmR2KgODGg97mwsOcWx'
//        , 'http://127.0.0.1:2081',
//        [
//            'Accept' => 'application/json'
//        ]
//    );
//
//        dd($res);
//
//        foreach ($res['results'] as $item) {
//            dd($item['title']);
//        }

//    dd(\Illuminate\Support\Facades\Cache::store('redis')->get('article'));

    dd(\Illuminate\Support\Facades\Cache::get('article_*'));
});

Route::get('topStories', [\App\Domain\NewsApi\Http\Controllers\Api\V1\NewsApiController::class , 'index']);

Route::get('set', function (){
    \Illuminate\Support\Facades\Cache::store('redis')->put('name', 'kkkkk', 600);

   dd(\Illuminate\Support\Facades\Cache::get('name'));
});
