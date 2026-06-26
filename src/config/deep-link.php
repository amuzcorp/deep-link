<?php

$appDomain = env('APP_DOMAIN') ?: parse_url(env('APP_URL', ''), PHP_URL_HOST) ?: 'lgscdev.lge.com';
$appDomain = parse_url($appDomain, PHP_URL_HOST) ?: $appDomain;
$appDomain = trim($appDomain, '/');
$isDevelopmentDomain = $appDomain === 'lgscdev.lge.com';

return [
    'prefix' => 'dl',
    'pages' => [
        'run' => 'deep-link::run',
        'fail' => 'deep-link::fail',
    ],
    'app' => [
        'ios' => [
            'scheme' => env('DEEPLINK_IOS_SCHEME', $isDevelopmentDomain ? 'lgscdev' : 'lgsc'),
            'install_route' => 'application-install.ios',
            'bundle' => env('DEEPLINK_IOS_BUNDLE', $isDevelopmentDomain ? 'com.lge.smartcheck.dev' : 'com.lge.smartcheck'),
        ],
        'android' => [
            'install_route' => 'application-install.aos',
            'scheme' => env('DEEPLINK_ANDROID_HOST', $appDomain),
            'package' => env('DEEPLINK_ANDROID_PACKAGE', $isDevelopmentDomain ? 'com.lge.smartcheck.dev' : 'com.lge.smartcheck'),
        ],
        'default' => [
            'install_route' => 'application-install.index',
        ],
    ],
];
