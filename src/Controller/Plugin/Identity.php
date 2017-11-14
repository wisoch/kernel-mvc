<?php

namespace Kernel\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Kernel\Mvc\Model\ModelManager;
use Firebase\JWT\JWT;

class Identity extends AbstractPlugin
{
    protected $identity;

    public function __invoke()
    {
        return $this->identity;
    }

    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    public static function encode($payload, $key)
    {
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function decode($data, $key)
    {
        try {
            $decoded = (array) JWT::decode($data, $key, ['HS256']);
            return $decoded;
        } catch(\Exception $e) {
            return [];
        }
    }
}
