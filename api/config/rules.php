<?php
return [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'api/v1/position', 'api/v1/author', 'api/v1/book',
        ],
        'extraPatterns' => [
            'POST create' => 'create-book',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'api/v1/authorize',
        ],
        'extraPatterns' => [
            'POST ' => 'authorize',
            'GET me' => 'me',
            'GET logout' => 'logout',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'api/v1/register',
        ],
        'extraPatterns' => [
            'POST client' => 'register-client',
            'POST worker' => 'register-worker',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'api/v1/taken',
        ],
        'extraPatterns' => [
            'POST ' => 'create',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'api/v1/returned',
        ],
        'extraPatterns' => [
            'POST ' => 'create',
        ]
    ],
];