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

        $date = date('Y-m-d', time());
        $host = $_SERVER['HTTP_HOST'];

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
            
            // 'log' => [
            //     'Logger' => [
            //         'writers' => [
            //             [
            //                 'name'    => 'stream',
            //                 'options' => [
            //                     'stream'    => "{$GLOBALS['path_log']}/{$host}/{$date}.log",
            //                     'chmod'     => 0775,
            //                     'formatter' => ['name' => 'simple', 'options' => ['dateTimeFormat' => 'Y-m-d H:i:s']]
            //                 ]
            //             ]
            //         ],
            //         'processors' => [
            //             ['name' => 'requestid']
            //         ]
            //     ]
            // ],
            
        ];
    }

    // public function init(ModuleManagerInterface $mm)
    // {
    //     $event     = $mm->getEvent();
    //     $container = $event->getParam('ServiceManager');
    //     $listener  = $container->get('ServiceListener');

    //     $listener->addServiceManager(
    //         'ModelManager',
    //         'models',
    //         'Hqq\Kernel\ModuleManager\Feature\ModelProviderInterface',
    //         'getModelConfig'
    //     );

    //     $listener->addServiceManager(
    //         'ModelPluginManager',
    //         'model_plugins',
    //         'Hqq\Kernel\ModuleManager\Feature\ModelPluginProviderInterface',
    //         'getModelPluginConfig'
    //     );

    //     $listener->addServiceManager(
    //         'DaoManager',
    //         'daos',
    //         'Hqq\Kernel\ModuleManager\Feature\DaoProviderInterface',
    //         'getDaoConfig'
    //     );

    //     $listener->addServiceManager(
    //         'RpcManager',
    //         'rpcs',
    //         'Hqq\Kernel\ModuleManager\Feature\RpcProviderInterface',
    //         'getRpcConfig'
    //     );
    // }

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