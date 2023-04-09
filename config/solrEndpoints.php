<?php

return [
    'active' => 'testing',
    'testing' => [
        'endpoint' => [
            'testing' => [
                'host' => 'localhost',
                'port' => 8983,
                'path' => '/',
                'core' => 'testing',
            ],
        ],
        'facetFields' => [
            'pubyear',
            'authors',
            'country',
            'format',
            'topic',
        ],
        'searchResultFields' => [
            'title',
            'format',
            'topic',
        ],
    ],
];
