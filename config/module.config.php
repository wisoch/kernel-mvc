<?php

namespace Application;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router'      => include __DIR__ . '/router.config.php',

    'controllers' => [
        'factories' => [
            Controller\DashboardController::class => InvokableFactory::class
        ],
    ],

    'db' => [
        "adapters" => [
            "Global\Db\Master" => [
                "driver" => "Pdo",
                "dsn"    => "{$GLOBALS['database']['global.master']['dsn']}",
                "user"   => "{$GLOBALS['database']['global.master']['user']}",
                "pass"   => "{$GLOBALS['database']['global.master']['pass']}",
                "driver_options" => $GLOBALS['database']['global.master']['options'],
            ],
            "Global\Db\Slaver" => [
                "driver" => "Pdo",
                "dsn"    => "{$GLOBALS['database']['global.slaver']['dsn']}",
                "user"   => "{$GLOBALS['database']['global.slaver']['user']}",
                "pass"   => "{$GLOBALS['database']['global.slaver']['pass']}",
                "driver_options" => $GLOBALS['database']['global.master']['options'],
            ],
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
