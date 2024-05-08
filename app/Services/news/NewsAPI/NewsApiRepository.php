<?php

namespace App\Services\news\NewsAPI;

use App\Interface\NewsRepositoryInterface;
use App\Models\Article;
use App\Services\news\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Void_;

class NewsApiRepository extends BaseRepository implements NewsRepositoryInterface
{

    public static function create(array $data): Void
    {
        $article = Article::create([
            'title' => $data['title'] ?? 'N/A',
            'description' => $data['description'] ?? 'N/A',
            'author' => $data['author'] ?? 'N/A',
            'url' => $data['url'] ?? 'N/A',
            'published_at' => Carbon::parse($data['publishedAt']) ,
            'source' => 'News Api',
            'image_url' => $data['urlToImage'] ?? 'N/A',
            'content' => $data['content'] ?? 'N/A',
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
