<?php

namespace Kernel\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Kernel\Mvc\Model\ModelManager;

class Model extends AbstractPlugin
{
    /**
     * @var ModelManager
     */
    protected $models;

    /**
     * @param ModelManager $models
     */
    public function __construct(ModelManager $models)
    {
        $this->models = $models;
    }

    public function __invoke($model = null)
    {
        if ($model) {
            return $this->models->get($model);
        }

        return $this->models;
    }
}
