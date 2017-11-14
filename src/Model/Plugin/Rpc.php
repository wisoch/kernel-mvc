<?php

namespace Kernel\Mvc\Model\Plugin;

class Rpc extends AbstractPlugin
{
    protected $rpcs;

    public function __construct($rpcs)
    {
        $this->rpcs = $rpcs;
    }

    public function __invoke($name)
    {
        return $this->rpcs->get($name);
    }
}
