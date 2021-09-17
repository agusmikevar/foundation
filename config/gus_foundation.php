<?php

return [
    'http' => [
        'request' => [
            'feature' => [
                'model' => \App\Models\Auth\Feature::class,
            ],
            'widget' => [
                'model' => \App\Models\Auth\Widget::class,
            ],
            'report' => [
                'model' => \App\Models\Auth\Report::class,
            ],
        ],
    ],
    'macro' => [
        'register' => [
            'blueprints' => true,
            'rules' => true,
        ],
        'kernel' => \App\Macro\Kernel::class,
        'config' => [
            'rule' => [
                'prefix' => 'g',
            ],
        ],
    ],
    'observer' => [
        'kernel' => [
            \App\Observers\Kernel::class
        ],
    ],
    'eloquent' => [
        'kernel' => [
            \App\Models\Kernel::class
        ],
    ],
    'log_activity' => env('GUS_LOG_ACTIVITY', true),
];
