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

use GuzzleHttp\ClientInterface;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory as GuzzleClientFactory;
use Psr\Container\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container): ?ClientInterface
    {
        /** @var ConfigInterface $config */
        $config = $container->get('config');
        /** @var GuzzleClientFactory $factory */
        $factory = $container->get(GuzzleClientFactory::class);

        return $factory->create([
            'base_uri' => (string) $config->get('youdu.api', ''),
            'timeout' => (int) $config->get('youdu.timeout', 5),
        ]);
    }
}
