<?php

namespace Kernel\Mvc;

use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;

class HttpListener extends AbstractListenerAggregate
{
	public function attach(EventManagerInterface $events, $priority = 1)
    {
        // $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute']);
    }
}
