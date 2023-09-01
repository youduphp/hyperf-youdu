<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-youdu.
 *
 * @link     https://github.com/youduphp/hyperf-youdu
 * @document https://github.com/youduphp/hyperf-youdu/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
use function Hyperf\Support\env;

return [
    'api' => env('YOUDU_API', ''),
    'buin' => (int) env('YOUDU_BUIN', 0),
    'timeout' => (int) env('YOUDU_TIMEOUT', 2),

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

    'tmp_path' => env('YOUDU_TMP_PATH', '/tmp'),
];
