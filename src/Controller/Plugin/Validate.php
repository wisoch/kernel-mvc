<?php

namespace Hqq\Kernel\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Validator\ValidatorPluginManager;
use Zend\Validator\ValidatorChain;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ArrayUtils;

class Validate extends AbstractPlugin
{
    /**
     * @var ModelManager
     */
    protected $ValidatorPluginManager;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param ValidatorPluginManager $validators
     */
    public function __construct(ValidatorPluginManager $validators, RequestInterface $request)
    {
        $this->validators = $validators;
        $this->request    = $request;
    }

    public function __invoke($params, $reqiredLogin = false)
    {
        $query = $this->request->getQuery()->toArray();
        $post  = $this->request->getPost()->toArray();

        $merged = ArrayUtils::merge($query, $post);

        $return = [];
        foreach ($params as $name => $param) {
            if (empty($param['reqired'])) {
                if (!isset($merged[$name])) {
                    $return[$name] = $param['default'];
                } else {
                    $return[$name] = $merged[$name];
                }
            } else {
                if (!isset($merged[$name])) {
                    throw new \Exception();
                }
                $return[$name] = $merged[$name];
            }

            if (empty($param['validators'])) {
                continue;
            }

            foreach ($param['validators'] as $validator) {
                if (empty($validator['name'])) {
                    continue;
                }

                $validator = $this->validators->get($validator['name'], empty($validator['options'])? []: $validator['options']);
                if(!$validator->isValid($return[$name])) {
                    throw new \Exception(current($validator->getMessages()));
                }
            }
        }

        return $return;
    }
}
