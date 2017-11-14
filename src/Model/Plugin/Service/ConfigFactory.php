<?php

namespace Kernel\Mvc\Model\Plugin\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\Model\Plugin\Config;

class ConfigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $config = $container->get('Config');

        return new Config($config);
    }
}
