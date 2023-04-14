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
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use RuntimeException;
use YouduPhp\Youdu\Application as App;
use YouduPhp\Youdu\Config;

/**
 * @mixin App
 */
class Application
{
    protected string $name = 'default';

    public function __construct(?string $name = null)
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
            $config = $this->getContainer()->get(ConfigInterface::class);

            if (! $config->has("youdu.applications.{$this->name}")) {
                throw new RuntimeException(sprintf('The application "%s" is not exists.', $this->name));
            }

            $appConfig = new Config([
                'api' => (string) $config->get('youdu.api', ''),
                'timeout' => (int) $config->get('youdu.timeout', 5),
                'buin' => (int) $config->get('youdu.buin', 0),
                'app_id' => (string) $config->get("youdu.applications.{$this->name}.app_id", ''),
                'aes_key' => (string) $config->get("youdu.applications.{$this->name}.aes_key", ''),
                'tmp_path' => is_writable($config->get('youdu.tmp_path')) ? $config->get('youdu.tmp_path') : '/tmp',
            ]);

            $app = new App($appConfig, $this->getClient(), $this->getCache());
        }

        return $app;
    }

    protected function getClient(): ?ClientInterface
    {
        if (
            property_exists($this, 'client')
            /* @phpstan-ignore-next-line */
            && $this->client instanceof ClientInterface
        ) {
            /* @phpstan-ignore-next-line */
            return $this->client;
        }

        if (
            $this->getContainer()->has($id = 'youdu.guzzle.client')
            && ($client = $this->getContainer()->get($id)) instanceof ClientInterface
        ) {
            return $client;
        }

        return null;
    }

    protected function getCache(): ?CacheInterface
    {
        if (
            property_exists($this, 'cache')
            /* @phpstan-ignore-next-line */
            && $this->cache instanceof CacheInterface
        ) {
            /* @phpstan-ignore-next-line */
            return $this->cache;
        }

        if (
            $this->getContainer()->has($id = 'youdu.cache')
            && ($cache = $this->getContainer()->get($id)) instanceof CacheInterface
        ) {
            return $cache;
        }

        return null;
    }

    protected function getContainer(): ContainerInterface
    {
        return ApplicationContext::getContainer();
    }
}
