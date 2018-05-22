<?php

namespace Kernel\Mvc\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\Model\PluginManager;

class ModelPluginManagerFactory implements FactoryInterface
{
    /**
     * Create the model manager service
     *
     * Creates and returns an instance of ModelManager. The
     * only models this manager will allow are those defined in the
     * application configuration's "models" array. If a model is
     * matched, the scoped manager will attempt to load the model.
     * Finally, it will attempt to inject the model plugin manager
     * if the model implements a setPluginManager() method.
     *
     * @param  ContainerInterface $container
     * @param  string $Name
     * @param  null|array $options
     * @return ModelManager
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        return new PluginManager($container, $options? $options: []);
    }
}
