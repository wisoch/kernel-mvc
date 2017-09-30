<?php

namespace Kernel\Mvc\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Kernel\Mvc\HttpListener;

class HttpListenerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     * @return HttpListener
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        return new HttpListener();
    }
}
