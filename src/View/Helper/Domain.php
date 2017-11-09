<?php

namespace Kernel\Mvc\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Domain extends AbstractHelper
{
    protected $domains = [];

    public function __construct($domains = [])
    {
        if ($domains) {
            $this->setDomains($domains);
        }
    }

    public function __invoke($domain, $filename)
    {
        $prefix = '';
        if (isset($this->domains[$domain])) {
            $prefix = rtrim($this->domains[$domain], '/');
        }

        $filename   = ltrim($filename, '/');

        return $prefix.'/'.$filename;
    }

    public function setDomains($domains)
    {
        $this->domains = $domains;

        return $this;
    }
}
