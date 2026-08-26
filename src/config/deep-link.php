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
            'sha256_cert_fingerprints' => [
                '85:B5:AF:C9:23:88:87:F1:07:E1:C2:F3:E3:55:EA:B7:C5:47:24:C5:22:6E:D7:D4:4C:5D:46:9B:FE:DE:A6:7D',
            ],
        ],
        'default' => [
            'install_route' => 'application-install.index',
        ],
    ],
];
