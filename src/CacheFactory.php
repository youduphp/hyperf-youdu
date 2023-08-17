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

use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container): ?CacheInterface
    {
        return null;
    }
}
