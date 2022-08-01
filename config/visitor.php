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
    'ip_api_key' =>  '6c7db04800af479892e8dc2f04d51488',

    /**
     * This ip address will be used in development mode 
     * so that you can still recieve real data responses
     */
    'dev_ip' =>  '6c7db04800af479892e8dc2f04d51488',

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
    */
    'drivers' => [
        'jenssegers' => \Shetabit\Visitor\Drivers\JenssegersAgent::class,
        'UAParser' => \Shetabit\Visitor\Drivers\UAParser::class,
        'IpDriver' => \Shetabit\Visitor\Drivers\UAParser::class,
    ]
];
