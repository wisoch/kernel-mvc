<?php

namespace Kernel\Mvc\Model\Plugin;

use Kernel\Mvc\Model\ModelInterface;

abstract class AbstractPlugin implements PluginInterface
{
    /**
     * @var null|ModelInterface
     */
    protected $model;

    /**
     * Set the current model instance
     *
     * @param  ModelInterface $model
     * @return void
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Get the current model instance
     *
     * @return null|ModelInterface
     */
    public function getModel()
    {
        return $this->model;
    }
}
