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

use Hyperf\Engine\Contract\Http\V2\ClientFactoryInterface;

class ConfigProvider
{
    public function __invoke()
    {
        defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__, 2));

        return [
            'dependencies' => [
                ClientFactoryInterface::class => ClientFactory::class,
            ],
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
