<?php

namespace App\Services\news\NyTimes;

use App\Events\GetNews;
use App\Interface\NewsRepositoryInterface;
use App\Models\Article;
use App\Services\news\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class NYTimesNewsRepository extends BaseRepository implements NewsRepositoryInterface
{

    protected static string $source = 'New York Times';

    protected static bool $duplicated = false;
    public static function create(array $data) : Void
    {

        try{
            DB::beginTransaction();

            self::preventDuplicated($data);

            if(!self::$duplicated){
                $article = Article::on('mysql')->create([
                    'title' => $data['title'],
                    'description' => $data['abstract'],
                    'url' => $data['url'],
                    'author' => $data['byline'],
                    'image_url' => $data['multimedia'][0]['url'],
                    'published_at' => $data['published_date'],
                    'section' => $data['section'],
                    'source' => 'New York Times',
                ]);


                Cache::store('redis')->put("article_$article->id" , $article , config('cache.redis_ttl'));

                Cache::store('redis')->put('latestArticles' , Article::whereDate('created_at', '<=', now()
                    ->subDays(2)->setTime(0, 0, 0)->toDateTimeString())
                    ->orderBy('created_at' , 'desc')->get() , config('cache.redis_ttl'));

                self::setLastUpdatedAt(Carbon::now());

                DB::commit();
            }



        }catch (\Exception $exception){
            DB::rollback();

            throw $exception;
        }


    }

    public function update(array $data): Void
    {
        // TODO: Implement update() method.
    }

    public function destroy(string $id): Void
    {
        // TODO: Implement destroy() method.
    }

    public static function preventDuplicated($data): void
    {
        if(Article::where('title' , $data['title'])->where('source' ,  self::$source)->exists()){
            self::$duplicated = true;
        }
    }
}
