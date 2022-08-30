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
use YouduPhp\Youdu\Application as Youdu;
use YouduPhp\Youdu\Config;

/**
 * @mixin Youdu
 */
class Application
{
    protected string $name = 'default';

    protected Youdu $application;

    public function __construct(?string $name = null, protected ConfigInterface $config)
    {
        $name ??= $this->name;

        $api = $this->config->get('youdu.api', '');
        $buin = (int) $this->config->get('youdu.buin', 0);
        $timeout = (int) $this->config->get('youdu.timeout', 5);
        $item = $this->config->get('youdu.applications.' . $name);

        $config = new Config([
            'api' => $api,
            'timeout' => $timeout,
            'buin' => $buin,
            'app_id' => $item['app_id'] ?? '',
            'aes_key' => $item['aes_key'] ?? '',
            'tmp_path' => $item['tmp_path'] ?? '/tmp',
        ]);

        $this->application = new Youdu($config);
    }

    public function __call($name, $arguments)
    {
        return $this->application->{$name}(...$arguments);
    }
}
