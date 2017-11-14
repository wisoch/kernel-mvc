<?php

namespace Kernel\Mvc\Model\Plugin;

class Config extends AbstractPlugin
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __invoke()
    {
        return $this->config;
    }
}
