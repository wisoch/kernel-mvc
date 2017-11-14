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
                'ModelManager'      => Model\ModelManager::class,
                'TableManager'      => Table\TableManager::class,
            ],
            'factories' => [
                'Kernel\Log\Logger' => Service\LoggerFactory::class,
                HttpListener::class => InvokableFactory::class,
                Db\Adapter\Profiler\Profiler::class => Db\Adapter\Profiler\Service\ProfilerFactory::class,
                Model\ModelManager::class           => Service\ModelManagerFactory::class,
                Table\TableManager::class           => Service\TableManagerFactory::class,
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
                'model'    => Controller\Plugin\Model::class,
                'identity' => Controller\Plugin\Identity::class,
            ],
            'factories' => [
                Controller\Plugin\Model::class    => Controller\Plugin\Service\ModelFactory::class,
                Controller\Plugin\Identity::class => InvokableFactory::class,
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
