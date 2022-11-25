<?php

return [
    'all_books' => [
        'html' => 'test.html',
        'css' => ['test.css'],
        'js' => [
            'headjs' => ['testhead.js'],
            'bottomjs' => ['testfooter.js']
        ]
    ],
    'index' => [
        'html' => 'index.html',
        'css' => [
            'index.css',
            'header.css'
        ]
    ],
    'about' => [
        'html' => 'about.html',
        'css' => [
            'about.css',
            'header.css'
        ]
    ],
    'docs' => [
        'html' => 'docs.html',
        'js' => [
            'bottomjs' => ['docs.js']
        ],
        'css' => [
            'docs.css',
            'header.css'
        ]
    ],
    'error' => [
        'html' => '404.html',
        'css' => ['404.css']
    ]
];