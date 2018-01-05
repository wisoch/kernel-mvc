<?php

namespace Kernel\Mvc;

use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\ModelInterface;
use Zend\Stdlib\ResponseInterface;

class HttpListener extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_BOOTSTRAP, [$this, 'onBootstrap']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, [$this, 'onFinish']);
    }

    public function onBootstrap(MvcEvent $e)
    {
        $services = $e->getApplication()->getServiceManager();

        $request = $services->get('Request');
        $logger  = $services->get('Kernel\Log\Logger');

        $uri     = $request->getRequestUri();
        $method  = $request->getMethod();
        $content = $request->getContent();
        $server  = $request->getServer();

        $logger->info("{$method} {$uri} {$content}");
    }

    public function onFinish(MvcEvent $e)
    {
        $services = $e->getApplication()->getServiceManager();

        $logger = $services->get('Kernel\Log\Logger');

        $result = $e->getResult();
        if ($result instanceof ModelInterface) {
            if ($e->isError()) {
                $reason = $result->getVariable('reason');
                if ($reason) {
                    $logger->err($reason);
                }

                $exception = $result->getVariable('exception');
                if ($exception) {
                    $message = $exception->__toString();
                    $logger->err($message);
                }
            }

            $variables = $result->getVariables();
        } elseif ($result instanceof ResponseInterface) {
            $variables = $result->getContent();
        }
        // $return = json_encode($variables, JSON_UNESCAPED_UNICODE);
        // $logger->info($return);

        return ;
    }
}
