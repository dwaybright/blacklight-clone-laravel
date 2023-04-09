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
        'defaultSearchField' => 'all',
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
