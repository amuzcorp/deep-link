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
            'bundle' => 'com.lge.lgsc',
        ],
        'android' => [
            'install_route' => 'application-install.aos',
            'scheme' => 'lgsc',
            'package' => 'com.lge.lgsc',
        ],
        'default' => [
            'install_route' => 'application-install.index'
        ]
    ]
];
