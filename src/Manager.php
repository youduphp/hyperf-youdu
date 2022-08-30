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
use YouduPhp\Youdu\Application;
use YouduPhp\Youdu\Config;

class Manager
{
    /**
     * @var Application[]
     */
    protected array $applications = [];

    public function __construct(protected ConfigInterface $config)
    {
        $api = $this->config->get('youdu.api', '');
        $buin = (int) $this->config->get('youdu.buin', 0);
        $timeout = (int) $this->config->get('youdu.timeout', 5);

        foreach ($this->config->get('youdu.applications', []) as $appConfig) {
            $config = new Config([
                'api' => $api,
                'timeout' => $timeout,
                'buin' => $appConfig['buin'],
                'app_id' => $appConfig['app_id'] ?? '',
                'aes_key' => $appConfig['aes_key'] ?? '',
                'tmp_path' => $appConfig['tmp_path'] ?? '/tmp',
            ]);
            $this->applications[] = make(Application::class, ['config' => $config]);
        }
    }

    public function app(string $name = null): Application
    {
        $name = $name ?? $this->config->get('youdu.default', 'default');

        if (! isset($this->applications[$name])) {
            throw new \RuntimeException(sprintf('The application "%s" is not exists.', $name));
        }

        return $this->applications[$name];
    }
}
