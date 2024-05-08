<?php

use Illuminate\Support\Facades\Schedule;


Schedule::call(function(){
    \App\Jobs\GetTopStories::dispatch()->onQueue('NYTimes')->onConnection('redis');
    \App\Jobs\GetNewsApiArticles::dispatch()->onQueue('NewsApi')->onConnection('redis');
})->everyMinute();


Schedule::command('php artisan queue:retry all')->everyMinute();
