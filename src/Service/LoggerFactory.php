<?php

namespace Kernel\Mvc\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Log\Logger;

class LoggerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     * @return HttpListener
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $date    = date('Y-m-d', time());
        $options = [
            'writers' => [
                [
                    'name'    => 'stream',
                    'options' => [
                        'stream'    => "data/log/{$date}.log",
                        'chmod'     => 0640,
                        'formatter' => ['name' => 'simple', 'options' => ['dateTimeFormat' => 'Y-m-d H:i:s']]
                    ]
                ]
            ],
            'processors' => [
                ['name' => 'requestid']
            ]
        ];

        return new Logger($options);
    }
}
