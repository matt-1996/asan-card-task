<?php

return [

    'nytimes' => [
        'apiKey' => env('NYTIMES_API_KEY' , 'null'),
        'urls' => [
            'topStories' => 'https://api.nytimes.com/svc/topstories/v2/fashion.json'
        ]
    ]
];
