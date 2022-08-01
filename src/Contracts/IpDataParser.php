<?php

namespace Shetabit\Visitor\Contracts;

use Shetabit\Visitor\Drivers\IpGeolocation;

interface IpDataParser
{
    /**
     * Process the retrived geodata from the IP address.
     *
     * @return string
     */
    public function data() : array;

    /**
     * Get the continent from ip info.
     *
     * @return string
     */
    public function continent() : string;

    /**
     * Get the country flag from ip info.
     *
     * @return string
     */
    public function flag() : string;

    /**
     * Get the country from ip info.
     *
     * @return string
     */
    public function country() : string;

    /**
     * Get the state from ip info.
     *
     * @return string
     */
    public function state() : string;

    /**
     * Get the state from ip info.
     *
     * @return string
     */
    public function city() : string;

    /**
     * Get the zip from ip info.
     *
     * @return string
     */
    public function zip() : string;

    /**
     * Retrieve geodata from the IP address.
     *
     * @return string
     */
    public function fetch() : object;

    /**
     * Retrieve geodata from the database.
     *
     * @return string
     */
    public function load($model) : object;
}