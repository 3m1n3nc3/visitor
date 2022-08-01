<?php

namespace Shetabit\Visitor\Drivers;

use UAParser\Parser;
use Illuminate\Http\Request;
use Shetabit\Visitor\Contracts\IpDataParser;

class IpStack implements IpDataParser
{
    /**
     * Request container.
     *
     * @var Request
     */
    protected $request;

    /**
     * IpStack constructor.
     *
     * @param Request $request
     *
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Process the retrived geodata from the IP address.
     *
     * @return string
     */
    public function data() : string {

    }

    /**
     * Retrieve geodata from the IP address.
     *
     * @return string
     */
    public function fetch() : string{
        
    }
}
