<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following driver to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => 'jenssegers',

    //except save request or route names
    'except' =>  ['login', 'register'],

    //name of the table which visit records should save in
    'table_name' =>  'shetabit_visits',

    //API key for the selected IpDriver
    'ip_api_key' =>  env('VISITOR_IP_API_KEY'),

    /**
     * This ip address will be used in development mode
     * so that you can still recieve real data responses
     */
    'dev_ip' =>  env('VISITOR_DEV_IP'),

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to implement
    | Shetabit\Visitor\Contracts\UserAgentParser in your driver.
    |
    | Available IpDrivers include:
    | \Shetabit\Visitor\Drivers\IpGeolocation::class
    | \Shetabit\Visitor\Drivers\IpStack::class
    | If you would like to use your own custom driver
    | your driver would need to implement
    | the Shetabit\Visitor\Contracts\IpDataParser interface
    |
    */
    'drivers' => [
        'jenssegers' => \Shetabit\Visitor\Drivers\JenssegersAgent::class,
        'UAParser' => \Shetabit\Visitor\Drivers\UAParser::class,
        'IpDriver' => \Shetabit\Visitor\Drivers\IpGeolocation::class,
    ]
];