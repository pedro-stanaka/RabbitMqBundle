<?php

declare(strict_types=1);

namespace OldSound\RabbitMqBundle\Tests\TestApp;

use OldSound\RabbitMqBundle\OldSoundRabbitMqBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles(): array
    {
        return [
            new OldSoundRabbitMqBundle(),
            new FrameworkBundle(),
        ];
    }

    public function getCacheDir(): string
    {
        return dirname(__DIR__, 2) . '/cache/' . spl_object_hash($this);
    }

    protected function configureContainer(ContainerConfigurator $configurator): void
    {
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(
            function (ContainerBuilder $container): void {
                $container->setParameter('container.autowiring.strict_mode', true);
                $container->setParameter('container.dumper.inline_class_loader', true);

                $container->addObjectResource($this);
            }
        );
        $loader->load($this->getRootDir() . '/config/config.yml');
    }

    public function getRootDir(): string
    {
        return __DIR__;
    }
}
