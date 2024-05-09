<?php

namespace App\Jobs;

use App\Events\GetNews;
use App\Services\HttpRequest\CustomRequest;
use App\Services\news\NewsAPI\NewsApiRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GetNewsApiArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    private string $apiKey;
    public function __construct()
    {
        $this->apiKey = config('news.newsApi.apiKey');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = CustomRequest::get(config('news.newsApi.urls.everything') . "?q=bitcoin&apiKey=" . $this->apiKey
            . '&pageSize=10'
            , config('proxy.http')
            , ['Accept' => 'application/json']);


        foreach ($response['articles'] as $article) {
            NewsApiRepository::create($article);
        }


    }

    public function uniqueVia(): Repository
    {
        return
            Cache::driver('redis');
    }
}
