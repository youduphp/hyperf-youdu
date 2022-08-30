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

use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory as GuzzleClientFactory;
use Psr\Container\ContainerInterface;

class ClientFactory
{
    public function __construct(ContainerInterface $container)
    {
        /** @var GuzzleClientFactory $clientFactory */
        $clientFactory = $container->get(GuzzleClientFactory::class);

        /** @var ConfigInterface $config */
        $config = $container->get(ConfigInterface::class);

        $api = $config->get('youdu.api', '');
        $timeout = (int) $config->get('youdu.timeout', 5);

        return $clientFactory->create([
            'base_uri' => $api,
            'timeout' => $timeout,
        ]);
    }
}
