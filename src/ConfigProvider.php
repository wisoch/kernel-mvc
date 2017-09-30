<?php

namespace Kernel\Mvc;

use Zend\ServiceManager\Factory\InvokableFactory;
use Hqq\Kernel\View;

class ConfigProvider
{
    public function getDependencyConfig()
    {
        return [
            'abstract_factories' => [
                
            ],
            'aliases' => [
                'HttpListener' => HttpListener::class,
            ],
            'factories' => [
                HttpListener::class => Service\HttpListenerFactory::class,
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
                
            ],
            'factories' => [
                
            ],
        ];
    }
}
