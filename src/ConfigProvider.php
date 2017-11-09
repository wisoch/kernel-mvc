<?php

namespace Kernel\Mvc;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Mvc;
use Kernel\Db;

class ConfigProvider
{
    public function getDependencyConfig()
    {
        return [
            'abstract_factories' => [
                Db\Adapter\AdapterAbstractServiceFactory::class,
            ],
            'aliases' => [
                'HttpListener'      => HttpListener::class,
            ],
            'factories' => [
                'Kernel\Log\Logger' => Service\LoggerFactory::class,
                HttpListener::class => InvokableFactory::class,
                Db\Adapter\Profiler\Profiler::class => Db\Adapter\Profiler\Service\ProfilerFactory::class,
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'abstract_factories' => [
                Mvc\Controller\LazyControllerAbstractFactory::class,
            ],
            'aliases' => [

            ],
            'factories' => [

            ],
        ];
    }

    public function getControllerPluginConfig()
    {
        return [
            'aliases' => [

            ],
            'factories' => [

            ],
        ];
    }

    public function getModelPluginConfig()
    {
        return [
            'aliases' => [

            ],
            'factories' => [

            ],
        ];
    }

    public function getViewHelpersConfig()
    {
        return [
            'aliases' => [
                'Domain' => View\Helper\Domain::class,
                'domain' => View\Helper\Domain::class
            ],
            'factories' => [
                View\Helper\Domain::class => View\Helper\Service\DomainFactory::class,
            ],
        ];
    }
}
