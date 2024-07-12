<?php

declare(strict_types=1);

namespace Paysera\LoggingExtraBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class PayseraLoggingExtraExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('paysera_logging_extra.application_name', $config['application_name']);
        $container->setParameter('paysera_logging_extra.grouped_exceptions', $config['grouped_exceptions']);
        $container->setParameter('paysera_logging_extra.monolog.minimum_introspection_level', $config['monolog']['minimum_introspection_level']);
        $container->setParameter('paysera_logging_extra.sentry.minimum_log_level', $config['sentry']['minimum_log_level']);
    }
}
