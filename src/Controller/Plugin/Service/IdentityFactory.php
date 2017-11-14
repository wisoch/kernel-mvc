<?php

namespace Hqq\Kernel\Mvc\Controller\Plugin\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Hqq\Kernel\Mvc\Controller\Plugin\Identity;

class IdentityFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        if (! $container->has('ModelManager')) {
            throw new ServiceNotCreatedException(sprintf(
                '%s requires that the application service manager contains a "%s" service; none found',
                __CLASS__,
                'ModelManager'
            ));
        }
        $models  = $container->get('ModelManager');
        $request = $container->get('Request');

        return new Identity($request, $models);
    }
}
