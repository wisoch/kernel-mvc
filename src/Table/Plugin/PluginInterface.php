<?php

namespace Kernel\Mvc\Model\Plugin;

use Kernel\Mvc\Model\ModelInterface;

interface PluginInterface
{
    /**
     * Set the current model instance
     *
     * @param  ModelInterface $model
     * @return void
     */
    public function setModel(ModelInterface $model);

    /**
     * Get the current model instance
     *
     * @return null|ModelInterface
     */
    public function getModel();
}
