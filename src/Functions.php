<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-youdu.
 *
 * @link     https://github.com/youduphp/hyperf-youdu
 * @document https://github.com/youduphp/hyperf-youdu/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
use Hyperf\Utils\ApplicationContext;
use YouduPhp\HyperfYoudu\Application;
use YouduPhp\HyperfYoudu\ApplicationFactory;

if (! function_exists('youdu')) {
    function youdu(string $name = 'default'): Application
    {
        /** @var ApplicationFactory $factory */
        $factory = ApplicationContext::getContainer()->get(ApplicationFactory::class);

        return $factory->get($name);
    }
}
