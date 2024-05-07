<?php

namespace App\Services\news\topStories;

use App\Interface\NewsRepositoryInterface;

class TopStories
{
    public function __construct(private NewsRepositoryInterface $newsRepository){}

    public function getTopStories(){
        return $this->newsRepository->get();
    }
}
