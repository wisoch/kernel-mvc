<?php

namespace Kernel\Mvc\Model\Plugin;

class Dao extends AbstractPlugin
{
    protected $daos;

    public function __construct($daos)
    {
        $this->daos = $daos;
    }

    public function __invoke($name)
    {
        return $this->daos->get($name);
    }
}
