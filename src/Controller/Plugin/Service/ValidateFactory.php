<?php

namespace Hqq\Kernel\Mvc\Controller\Plugin\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Validator\ValidatorPluginManager;
use Hqq\Kernel\Mvc\Controller\Plugin\Validate;

class ValidateFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        return new Validate(new ValidatorPluginManager($container) , $container->get('Request'));
    }
}
