<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-youdu.
 *
 * @link     https://github.com/youduphp/hyperf-youdu
 * @document https://github.com/youduphp/hyperf-youdu/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace YouduPhp\HyperfYoudu;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for hyperf-youdu.',
                    'source' => __DIR__ . '/../publish/youdu.php',
                    'destination' => BASE_PATH . '/config/autoload/youdu.php',
                ],
            ],
        ];
    }
}
