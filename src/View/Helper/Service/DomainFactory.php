<?php

namespace Kernel\Mvc\View\Helper\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\View\Helper\Domain;

class DomainFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $config = $container->get('Config');
        $domains = empty($config['domains'])? []: $config['domains'];

        return new Domain($domains);
    }
}
