<?php

namespace Kernel\Mvc\Model\Plugin\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\Model\Plugin\Table;

class TableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $tables = $container->get('TableManager');

        return new Table($tables);
    }
}
