<?php

namespace Kernel\Mvc\Model;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;

class PluginManager extends AbstractPluginManager
{
    /**
     * Plugins must be of this type.
     *
     * @var string
     */
    protected $instanceOf = Plugin\PluginInterface::class;

    /**
     * @var ModelInterface
     */
    protected $model;

    /**
     * Retrieve a registered instance
     *
     * After the plugin is retrieved from the service locator, inject the
     * model in the plugin every time it is requested. This is required
     * because a model can use a plugin and another model can be
     * dispatched afterwards. If this second model uses the same plugin
     * as the first model, the reference to the model inside the
     * plugin is lost.
     *
     * @param  string $name
     * @return ModelInterface
     */
    public function get($name, array $options = null)
    {
        $plugin = parent::get($name, $options);
        $this->injectModel($plugin);

        return $plugin;
    }

    /**
     * Set model
     *
     * @param  DispatchableInterface $model
     * @return PluginManager
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Retrieve model instance
     *
     * @return null|DispatchableInterface
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Inject a helper instance with the registered model
     *
     * @param  object $plugin
     * @return void
     */
    public function injectModel($plugin)
    {
        if (!is_object($plugin)) {
            return;
        }
        if (!method_exists($plugin, 'setModel')) {
            return;
        }

        $model = $this->getModel();
        if (!$model instanceof ModelInterface) {
            return;
        }

        $plugin->setModel($model);
    }

    /**
     * Validate a plugin
     *
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
