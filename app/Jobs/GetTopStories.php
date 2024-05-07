<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\HttpRequest\CustomRequest;
use App\Services\news\NewsAPI\NewsApiRepository;
use App\Services\news\NyTimes\NYTimesNewsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GetTopStories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     */
    private string $apiToken;
    public function __construct()
    {
        $this->apiToken = config('news.nytimes.apiKey');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = CustomRequest::get( config('news.nytimes.urls.topStories') .'?api-key= ' . $this->apiToken
            , config('proxy.http'),
            [
                'Accept' => 'application/json'
            ]);

        foreach ($response['results'] as $res) {
            NYTimesNewsRepository::create($res);
        }
    }
}
