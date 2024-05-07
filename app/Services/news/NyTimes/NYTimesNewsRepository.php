<?php

namespace App\Services\news\NyTimes;

use App\Interface\NewsRepositoryInterface;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NYTimesNewsRepository implements NewsRepositoryInterface
{

    public static function get(Request $request)
    {
       $articles = collect(Cache::store('redis')->get('articles'));

       return $articles->take($request->paginate ?? 10)
           ->whereBetween('published_at', [Carbon::createFromDate($request->start_date . '00:00')
               , Carbon::createFromDate($request->end_date . "23:59")])
           ->when($request->source , function ($query) use ($request) {
               return $query->where('source' , $request->source);
           });
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

    public static function create(array $data)
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

        Cache::store('redis')->put("article_$article->id" , $article , 6000000000);

        Cache::store('redis')->put('articles' , Article::all() , 6000000000);

    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function destroy(string $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
