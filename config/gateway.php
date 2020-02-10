<?php

return [

    //-------------------------------
    // Timezone for insert dates in database
    // If you want Gateway not set timezone, just leave it empty
    //--------------------------------
    'timezone' => 'Asia/Tehran',

    //--------------------------------
    // Zarinpal gateway
    //--------------------------------
//    'zarinpal' => [
//        'merchant-id'  => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
//        'type'         => 'normal',             // Types: [zarin-gate || normal]
//        'callback-url' => '/',
//        'server'       => 'test',
//        'email'        => 'email@gmail.com',
//        'mobile'       => '09xxxxxxxxx',
//        'description'  => 'وب سایت شخصی علاء شریعتی',
//    ],

    'zarinpal' => [
        'merchant-id'  => '6e855902-4842-11e8-9b21-005056a205be',
        'type'         => 'normal',             // Types: [zarin-gate || normal]
        'callback-url' => '/',
        'server'       => 'iran',             // Servers: [germany || iran || test]
        'email'        => 'reza.kalantarian96@gmail.com',
        'mobile'       => '09125363822',
        'description'  => 'ایران دتپک',
    ],

    //--------------------------------
    // Mellat gateway
    //--------------------------------
    'mellat' => [
        'username'     => '',
        'password'     => '',
        'terminalId'   => 0000000,
        'callback-url' => '/'
    ],

    //--------------------------------
    // Saman gateway
    //--------------------------------
    'saman' => [
        'merchant'     => '',
        'password'     => '',
        'callback-url'   => '/',
    ],

    //--------------------------------
    // Payline gateway
    //--------------------------------
    'payline' => [
        'api' => 'xxxxx-xxxxx-xxxxx-xxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'callback-url' => '/'
    ],

    //--------------------------------
    // Sadad gateway
    //--------------------------------
    'sadad' => [
        'merchant'      => '',
        'transactionKey'=> '',
        'terminalId'    => 000000000,
        'callback-url'  => '/'
    ],

    //--------------------------------
    // JahanPay gateway
    //--------------------------------
    'jahanpay' => [
        'api' => 'xxxxxxxxxxx',
        'callback-url' => '/'
    ],

    //--------------------------------
    // Parsian gateway
    //--------------------------------
    'parsian' => [
        'pin'          => 'xxxxxxxxxxxxxxxxxxxx',
        'callback-url' => '/'
    ],
    //--------------------------------
    // Pasargad gateway
    //--------------------------------
    'pasargad' => [
        'terminalId'    => 000000,
        'merchantId'    => 000000,
        'certificate-path'    => storage_path('gateway/pasargad/certificate.xml'),
        'callback-url' => '/gateway/callback/pasargad'
    ],
    //-------------------------------
    // Tables names
    //--------------------------------
    'table'=> 'gateway_transactions',
];
