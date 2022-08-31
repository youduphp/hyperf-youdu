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
use Hyperf\Guzzle\ClientFactory;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use YouduPhp\Youdu\Application as App;
use YouduPhp\Youdu\Config;

/**
 * @mixin App
 */
class Application
{
    protected string $name = 'default';

    public function __construct(protected ContainerInterface $container, ?string $name = null)
    {
        if (! is_null($name)) {
            $this->name = $name;
        }
    }

    public function __call($name, $arguments)
    {
        return $this->getApplication()->{$name}(...$arguments);
    }

    protected function getApplication(): App
    {
        static $app = null;

        if (is_null($app)) {
            /** @var ConfigInterface $config */
            $config = $this->container->get(ConfigInterface::class);
            $api = $config->get('youdu.api', '');
            $buin = (int) $config->get('youdu.buin', 0);
            $timeout = (int) $config->get('youdu.timeout', 5);
            $tmpPath = is_writable($config->get('youdu.tmp_path')) ? $config->get('youdu.tmp_path') : '/tmp';
            $item = $config->get('youdu.applications.' . $this->name, []);

            $appConfig = new Config([
                'api' => $api,
                'timeout' => $timeout,
                'buin' => $buin,
                'app_id' => $item['app_id'] ?? '',
                'aes_key' => $item['aes_key'] ?? '',
                'tmp_path' => $tmpPath,
            ]);

            $app = new App($appConfig, $this->getClient(), $this->getCache());
        }

        return $app;
    }

    protected function getCache(): ?CacheInterface
    {
        return null;
    }

    protected function getClient(): ?ClientInterface
    {
        /** @var ConfigInterface $config */
        $config = $this->container->get(ConfigInterface::class);
        $options = [
            'base_uri' => $config->get('youdu.api', ''),
            'timeout' => (int) $config->get('youdu.timeout', 5),
        ];

        /** @var ClientFactory $clientFactory */
        $clientFactory = $this->container->get(ClientFactory::class);

        return $clientFactory->create($options);
    }
}
