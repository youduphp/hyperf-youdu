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
use Psr\Container\ContainerInterface;
use RuntimeException;
use YouduPhp\Youdu\Application as App;
use YouduPhp\Youdu\Config;

use function Hyperf\Support\make;

/**
 * @mixin App
 */
class Application
{
    public function __construct(protected ContainerInterface $container, protected string $name = 'default')
    {
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

            $app = make(App::class, ['config' => $appConfig]);
        }

        return $app;
    }
}
