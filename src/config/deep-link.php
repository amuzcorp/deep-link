<?php

return [
    'prefix' => 'dl',
    'pages' => [
        'run' => 'deep-link::run',
        'fail' => 'deep-link::fail'
    ],
    'app' => [
        'ios' => [
            'scheme' => 'lgsc',
            'install_route' => 'application-install.ios',
            'bundle' => 'com.lge.smartcheck',
        ],
        'android' => [
            'install_route' => 'application-install.aos',
            'scheme' => 'lgsc.lge.com',
            'package' => 'com.lge.smartcheck',
        ],
        'default' => [
            'install_route' => 'application-install.index'
        ]
    ]
];
