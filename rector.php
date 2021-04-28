<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    $parameters->set(
        Option::PATHS,
        [
            __DIR__ . '/Command',
            __DIR__ . '/DataCollector',
            __DIR__ . '/DependencyInjection',
            __DIR__ . '/Event',
            __DIR__ . '/MemoryChecker',
            __DIR__ . '/Provider',
            __DIR__ . '/RabbitMq',
        ]
    );

    // Define what rule sets will be applied
    $parameters->set(Option::SETS, [
        SetList::DEAD_CODE,
        SetList::PHP_71,
        SymfonySetList::SYMFONY_43,
    ]);

    // get services (needed for register a single rule)
    // $services = $containerConfigurator->services();

    // register a single rule
    // $services->set(TypedPropertyRector::class);
};
