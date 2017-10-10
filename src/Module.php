<?php

namespace Kernel\Mvc;

use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;

class Module
{
    /**
     * Provide default router configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $provider = new ConfigProvider();

        return [
            'environment' => $GLOBALS['environment'],
            'domains'     => $GLOBALS['domains'],
            'view_manager' => [
                'strategies' => [
                    'ViewJsonStrategy'
                ],
            ],
            'service_manager'    => $provider->getDependencyConfig(),
            // 'controller_plugins' => $provider->getControllerPluginConfig(),
            // 'model_plugins'      => $provider->getModelPluginConfig(),
            // 'view_helpers'       => $provider->getViewHelpersConfig(),
        ];
    }

    public function init(ModuleManagerInterface $mm)
    {
        $event     = $mm->getEvent();
        $container = $event->getParam('ServiceManager');
        $listener  = $container->get('ServiceListener');

        $listener->addServiceManager(
            'ModelManager',
            'models',
            'Kernel\ModuleManager\Feature\ModelProviderInterface',
            'getModelConfig'
        );

        $listener->addServiceManager(
            'ModelPluginManager',
            'model_plugins',
            'Kernel\ModuleManager\Feature\ModelPluginProviderInterface',
            'getModelPluginConfig'
        );

        $listener->addServiceManager(
            'DaoManager',
            'dao',
            'Kernel\ModuleManager\Feature\DaoProviderInterface',
            'getDaoConfig'
        );

        $listener->addServiceManager(
            'RpcManager',
            'rpc',
            'Kernel\ModuleManager\Feature\RpcProviderInterface',
            'getRpcConfig'
        );
    }

    // public function onBootstrap(MvcEvent $event)
    // {
    //     $application = $event->getApplication();

    //     $events    = $application->getEventManager();
    //     $container = $application->getServiceManager();
    //     $logger    = $container->get('Logger');

    //     $listener = new Mvc\RuntimeListener($logger);
    //     $listener->attach($events);
    // }
}
