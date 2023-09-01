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
use RuntimeException;

use function Hyperf\Support\make;

class ApplicationFactory
{
    /**
     * @var Application[]
     */
    protected array $applications = [];

    public function __construct(protected ConfigInterface $config)
    {
        foreach ($this->config->get('youdu.applications', []) as $name => $item) {
            $this->applications[] = make(Application::class, ['name' => $name]);
        }
    }

    public function get(?string $name = null): Application
    {
        $name ??= $this->config->get('youdu.default', 'default');

        if (! isset($this->applications[$name])) {
            throw new RuntimeException(sprintf('The application "%s" is not exists.', $name));
        }

        return $this->applications[$name];
    }
}
