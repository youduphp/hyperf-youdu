<?php

declare(strict_types=1);
/**
 * This file is part of laravel-youdu.
 *
 * @link     https://github.com/youduphp/laravel-youdu
 * @document https://github.com/youduphp/laravel-youdu/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
return [
    'api' => env('YOUDU_API', ''),
    'timeout' => (int) env('YOUDU_TIMEOUT', 2),

    'buin' => (int) env('YOUDU_BUIN', 0),

    'default' => env('YOUDU_DEFAULT_APPLICATION', 'default'),
    'applications' => [
        'default' => [
            'app_id' => env('YOUDU_APP_ID', ''),
            'aes_key' => env('YOUDU_AES_KEY', ''),
        ],
        // 'another' => [
        //     'app_id'  => env('ANOTHER_YOUDU_APP_ID', ''),
        //     'aes_key' => env('ANOTHER_YOUDU_AES_KEY', ''),
        // ],
    ],

    'http' => [
        'options' => [
            'headers' => [
                'User-Agent' => env('YOUDU_HTTP_USER_AGENT', 'Youdu/2.0'),
            ],
        ],
    ],

    'file_save_path' => env('YOUDU_FILE_SAVE_PATH', '/tmp'),

    'notification' => [
        'queue' => env('YOUDU_NOTIFICATION_QUEUE', 'youdu_notification'),
        'delay' => env('YOUDU_NOTIFICATION_DELAY', 0),
        'tries' => env('YOUDU_NOTIFICATION_TRIES', 3),
    ],

    'exception' => [
        'ignore_environments' => [], // ['local', 'dev'],
        'receivers' => [], // youdu ID
        'report_app' => 'default',
        'report_now' => true,
        'show_git_branch' => false,
    ],
];
