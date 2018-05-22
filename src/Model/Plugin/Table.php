<?php

namespace Kernel\Mvc\Model\Plugin;

class Table extends AbstractPlugin
{
    protected $tables;

    public function __construct($tables)
    {
        $this->tables = $tables;
    }

    public function __invoke($name)
    {
        return $this->tables->get($name);
    }
}
