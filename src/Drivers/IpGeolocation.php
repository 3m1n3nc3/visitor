<?php

namespace Shetabit\Visitor\Drivers;

use UAParser\Parser;
use Illuminate\Http\Request;
use Shetabit\Visitor\Contracts\IpDataParser;

class IpGeolocation implements IpDataParser
{
    /**
     * Request container.
     *
     * @var Request
     */
    protected $request;

    /**
     * The IP info.
     *
     * @var Request
     */
    protected $info;

    /**
     * Ipgeolocation constructor.
     *
     * @param Request $request
     *
     */
    public function __construct(Request $request, $config)
    {
        $this->request = $request;
        $this->config = $config;
        $this->url = "https://api.ipgeolocation.io/ipgeo";
    }

    /**
     * Process the retrived geodata from the IP address.
     *
     * @return string
     */
    public function data() : string {
        return $this->fetch();
    }

    protected function ip()
    {
        if (stripos($this->request->ip(), '127.0.0') !== false && env('APP_ENV') === 'local') {
            return $this->config['dev_ip'] ?? $this->request->ip();
        }
        return $this->request->ip();
    }

    /**
     * Retrieve geodata from the IP address.
     *
     * @return string
     */
    public function fetch() : string 
    {
        $info = [];

        $ipInfo = \Illuminate\Support\Facades\Http::get($this->url, [
            'apiKey' => $this->config['ip_api_key']
            'ip' => $this->ip()
        ]);
        
        if ($ipInfo->status() === 200) {
            $info = $ipInfo->json() ?? $info;
        }

        $this->info = $info;

        return $this;
    }
}
