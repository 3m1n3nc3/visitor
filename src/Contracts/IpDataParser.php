<?php

namespace Shetabit\Visitor\Contracts;

interface IpDataParser
{
    /**
     * Process the retrived geodata from the IP address.
     *
     * @return string
     */
    public function data() : string;

    /**
     * Retrieve geodata from the IP address.
     *
     * @return string
     */
    public function fetch() : string;
}
