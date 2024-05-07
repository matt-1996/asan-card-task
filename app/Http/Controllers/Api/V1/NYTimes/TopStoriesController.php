<?php

namespace App\Http\Controllers\Api\V1\NYTimes;

use App\Http\Controllers\Controller;
use App\Interface\NewsRepositoryInterface;

class TopStoriesController extends Controller
{
    public function __construct(private NewsRepositoryInterface $newsRepository){

    }

    public function topStories(){
        return $this->newsRepository->get();
    }
}
