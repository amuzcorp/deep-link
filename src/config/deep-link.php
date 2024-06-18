<?php

return [
//    'prefix' => 'deep-link'
    'prefix' => 'dl',
    'pages' => [
        'run' => 'deep-link::run',
        'fail' => 'deep-link::fail'
    ],
    'app' => [
        'ios' => [
            'install_route' => 'application-install.ios',
            'bundle' => 'com.lge.lgsc',
        ],
        'android' => [
            'install_route' => 'application-install.android',
            'name' => 'lgsc',
            'package' => 'com.lge.lgsc',
        ],
        'default' => [
            'install_route' => 'application-install.index'
        ]
    ]
];
