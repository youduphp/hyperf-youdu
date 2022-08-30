<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-youdu.
 *
 * @link     https://github.com/youduphp/hyperf-youdu
 * @document https://github.com/youduphp/hyperf-youdu/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace YouduPhp\HyperfYoudu\Facades;

use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;
use YouduPhp\HyperfYoudu\Application;
use YouduPhp\HyperfYoudu\ApplicationFactory;

/**
 * @method static YouduPhp\HyperfYoudu\Application app(string $name = '')
 * @method static \YouduPhp\Youdu\Kernel\Dept\Client dept()
 * @method static \YouduPhp\Youdu\Kernel\Message\Client message()
 * @method static \YouduPhp\Youdu\Kernel\User\Client user()
 * @method static \YouduPhp\Youdu\Kernel\Session\Client session()
 * @method static \YouduPhp\Youdu\Kernel\Media\Client media()
 * @method static \YouduPhp\Youdu\Kernel\Group\Client group()
 */
class Youdu
{
    public static function __callStatic($name, $arguments)
    {
        return self::application()->{$name}(...$arguments);
    }

    public static function application(string $name = 'default'): Application
    {
        /** @var ContainerInterface $container */
        $container = ApplicationContext::getContainer();
        /** @var ApplicationFactory $factory */
        $factory = $container->get(ApplicationFactory::class);

        return $factory->get($name);
    }
}
