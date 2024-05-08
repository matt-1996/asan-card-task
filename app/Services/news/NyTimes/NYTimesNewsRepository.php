<?php

namespace App\Services\news\NyTimes;

use App\Events\GetNews;
use App\Interface\NewsRepositoryInterface;
use App\Models\Article;
use App\Services\news\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NYTimesNewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public static function create(array $data) : Void
    {
        $article = Article::on('mysql')->create([
            'title' => $data['title'],
            'description' => $data['abstract'],
            'url' => $data['url'],
            'author' => $data['byline'],
            'image_url' => $data['url'],
            'published_at' => $data['published_date'],
            'section' => $data['section'],
            'source' => 'New York Times',
        ]);


        Cache::store('redis')->put("article_$article->id" , $article , config('cache.redis_ttl'));

        Cache::store('redis')->put('articles' , Article::all() , config('cache.redis_ttl'));

    }

    public function update(array $data): Void
    {
        // TODO: Implement update() method.
    }

    public function destroy(string $id): Void
    {
        // TODO: Implement destroy() method.
    }
}
