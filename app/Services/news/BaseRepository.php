<?php

namespace App\Services\news;

use App\Events\GetNews;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BaseRepository
{

    protected static string $source;

    protected static bool $duplicated;
    public static function get(Request $request) : Collection
    {
        $articles = collect(Cache::store('redis')->get('articles'));

        $data = $articles->take($request->paginate ?? 10)
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereBetween('published_at', [Carbon::createFromDate($request->start_date . '00:00')
                    , Carbon::createFromDate($request->end_date . "23:59")]);
            })
            ->when($request->source , function ($query) use ($request) {
                return $query->where('source' , $request->source);
            });

        GetNews::dispatch($data->take(8)->toArray());

        return $data;
    }

    public function getById(string $id)
    {
        if(Cache::store('redis')->get("article_$id")){
            return Cache::store('redis')->get("article_$id");
        }else{
            $article = Article::findOrFail($id);

            Cache::store('redis')->put('article_$id', $article);

            return $article;
        }
    }

    public static function getLastUpdatedAt(): String
    {
        return Cache::store('redis')->get('lastUpdatedAt');
    }

    public static function setLastUpdatedAt(string $date): void
    {
        Cache::store('redis')->put("lastUpdatedAt" , $date, config('cache.redis_ttl'));
    }

}
