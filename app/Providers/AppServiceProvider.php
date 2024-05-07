<?php

namespace App\Providers;

use App\Domain\NewsApi\Http\Controllers\Api\V1\NewsApiController;
use App\Interface\NewsRepositoryInterface;
use App\Services\news\NewsAPI\NewsApiRepository;
use App\Services\news\NyTimes\NYTimesNewsRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsRepositoryInterface::class , NYTimesNewsRepository::class);

        $this->app->when(NewsApiController::class)
            ->needs(NewsRepositoryInterface::class)
            ->give(function () {
                return new NewsApiRepository();
            });

        Http::macro('getWithProxy' , function(string $url, string $proxy, array $headers) {
            $response = Http::withOptions([
                'proxy' => $proxy,
            ])
                ->withHeaders($headers)
                ->get($url);

            return $response->json();
        });

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
