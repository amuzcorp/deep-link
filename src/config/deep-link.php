<?php

$appDomain = env('APP_DOMAIN') ?: parse_url(env('APP_URL', ''), PHP_URL_HOST) ?: 'lgscdev.lge.com';
$appDomain = parse_url($appDomain, PHP_URL_HOST) ?: $appDomain;
$appDomain = trim($appDomain, '/');
$isDevelopmentDomain = $appDomain === 'lgscdev.lge.com';
$androidReleaseCertFingerprint = '85:B5:AF:C9:23:88:87:F1:07:E1:C2:F3:E3:55:EA:B7:C5:47:24:C5:22:6E:D7:D4:4C:5D:46:9B:FE:DE:A6:7D';
$androidCertFingerprints = [$androidReleaseCertFingerprint];

if ($isDevelopmentDomain) {
    $androidCertFingerprints[] = '10:CF:50:C2:15:91:FB:76:5F:EE:C9:BA:E8:4D:C0:4A:63:55:A1:36:36:0E:73:F6:1A:D3:62:42:A3:85:7F:05';
}

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
            'sha256_cert_fingerprints' => $androidCertFingerprints,
        ],
        'default' => [
            'install_route' => 'application-install.index',
        ],
    ],
];
