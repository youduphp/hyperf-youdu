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

class ClientFactory extends \YouduPhp\Youdu\Kernel\HttpClient\ClientFactory
{
    public function __construct(private GuzzleClientFactory $factory, private ConfigInterface $config)
    {
        $this->options = [
            'base_uri' => (string) $config->get('youdu.api', ''),
            'timeout' => (int) $config->get('youdu.timeout', 5),
        ];
    }

    public function create(array $options = []): ClientInterface
    {
        return $this->factory->create(array_merge($this->options, $options));
    }
}
