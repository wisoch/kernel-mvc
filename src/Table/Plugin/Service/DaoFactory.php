<?php

namespace Kernel\Mvc\Model\Plugin\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\Model\Plugin\Dao;

class DaoFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $daos = $container->get('DaoManager');

        return new Dao($daos);
    }
}
