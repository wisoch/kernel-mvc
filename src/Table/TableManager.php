<?php

namespace Kernel\Mvc\Table;

use Interop\Container\ContainerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Log\LoggerAwareInterface;

class TableManager extends AbstractPluginManager
{
    /**
     * Models must be of this type.
     *
     * @var string
     */
    protected $instanceOf = TableGatewayInterface::class;

    /**
     * Constructor
     *
     * Injects an initializer for injecting controllers with an
     * event manager and plugin manager.
     *
     * @param  ConfigInterface|ContainerInterface $container
     * @param  array $v3config
     */
    public function __construct($container, array $v3config = [])
    {
        $this->addInitializer([$this, 'injectEventManager']);
        $this->addInitializer([$this, 'injectPluginManager']);
        $this->addInitializer([$this, 'injectLogger']);
        parent::__construct($container, $v3config);
    }

    /**
     * Initializer: inject EventManager instance
     *
     * If we have an event manager composed already, make sure it gets injected
     * with the shared event manager.
     *
     * The AbstractController lazy-instantiates an EM instance, which is why
     * the shared EM injection needs to happen; the conditional will always
     * pass.
     *
     * @param ContainerInterface|DispatchableInterface $first Container when
     *     using zend-servicemanager v3; controller under v2.
     * @param DispatchableInterface|ContainerInterface $second Controller when
     *     using zend-servicemanager v3; container under v2.
     */
    public function injectLogger($first, $second)
    {
        if ($first instanceof ContainerInterface) {
            $container = $first;
            $model = $second;
        } else {
            $container = $second;
            $model = $first;
        }

        if (! $model instanceof LoggerAwareInterface) {
            return;
        }

        $model->setLogger($container->get('Kernel\Log\Logger'));
    }

    /**
     * Initializer: inject EventManager instance
     *
     * If we have an event manager composed already, make sure it gets injected
     * with the shared event manager.
     *
     * The AbstractController lazy-instantiates an EM instance, which is why
     * the shared EM injection needs to happen; the conditional will always
     * pass.
     *
     * @param ContainerInterface|DispatchableInterface $first Container when
     *     using zend-servicemanager v3; controller under v2.
     * @param DispatchableInterface|ContainerInterface $second Controller when
     *     using zend-servicemanager v3; container under v2.
     */
    public function injectEventManager($first, $second)
    {
        if ($first instanceof ContainerInterface) {
            $container = $first;
            $model = $second;
        } else {
            $container = $second;
            $model = $first;
        }

        if (! $model instanceof EventManagerAwareInterface) {
            return;
        }

        $events = $model->getEventManager();
        if (! $events || ! $events->getSharedManager() instanceof SharedEventManagerInterface) {
            // For v2, we need to pull the parent service locator
            if (! method_exists($container, 'configure')) {
                $container = $container->getServiceLocator() ?: $container;
            }

            $model->setEventManager($container->get('EventManager'));
        }
    }

    /**
     * Initializer: inject plugin manager
     *
     * @param ContainerInterface|DispatchableInterface $first Container when
     *     using zend-servicemanager v3; controller under v2.
     * @param DispatchableInterface|ContainerInterface $second Controller when
     *     using zend-servicemanager v3; container under v2.
     */
    public function injectPluginManager($first, $second)
    {
        $container = $first;
        $model = $second;

        if (! method_exists($model, 'setPluginManager')) {
            return;
        }

        $model->setPluginManager($container->get('ModelPluginManager'));
    }

    /**
     * {@inheritDoc}
     */
    public function validate($plugin)
    {
        if (! $plugin instanceof $this->instanceOf) {
            throw new InvalidServiceException(sprintf(
                'Plugin of type "%s" is invalid; must implement %s',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
                $this->instanceOf
            ));
        }
    }
}
