<?php

namespace Shetabit\Visitor\Drivers;

use Illuminate\Database\Eloquent\Model;
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
     * The IP info.
     *
     * @var array
     */
    protected $info;

    /**
     * Ipgeolocation constructor.
     *
     * @param Request $request
     *
     */
    public function __construct(Request $request)
    {
        $this->config = config('visitor');
        $this->request = $request;
        $this->url = "http://api.ipstack.com/";
    }

    /**
     * Process the retrived geodata from the IP address.
     *
     * @return string
     */
    public function data() : array {
        return $this->info;
    }

    /**
     * Convert the proccessed geodata from the IP address to json.
     *
     * @return string
     */
    public function json() : string {
        return collect($this->info)->__toString();
    }

    /**
     * Get the continent from ip info.
     *
     * @return string
     */
    public function continent() : string {
        return $this->info['continent_name'];
    }

    /**
     * Get the country flag from ip info.
     *
     * @return string
     */
    public function flag() : string {
        return $this->info['country_flag'];
    }

    /**
     * Get the country from ip info.
     *
     * @return string
     */
    public function country() : string {
        return $this->info['country_name'];
    }

    /**
     * Get the state from ip info.
     *
     * @return string
     */
    public function state() : string {
        return $this->info['region_name'];
    }

    /**
     * Get the state from ip info.
     *
     * @return string
     */
    public function city() : string {
        return $this->info['city'];
    }

    /**
     * Get the zip from ip info.
     *
     * @return string
     */
    public function zip() : string {
        return $this->info['zip'];
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
    public function fetch() : object
    {
        $info = [];

        if ($this->info && $this->info['ip'] === $this->ip()) {
            return $this->info;
        }
        $ipInfo = \Illuminate\Support\Facades\Http::get($this->url . $this->ip(), [
            'access_key' => $this->config['ip_api_key'],
        ]);

        if ($ipInfo->status() === 200) {
            $info = $ipInfo->json() ?? $info;
        }

        $this->info = $info;

        return $this;
    }

    /**
     * Retrieve geodata from the database.
     *
     * @return string
     */
    public function load($model) : object
    {
        if (is_string($model) && app($model) instanceof Model) {
            $model = app($model);
        } else {
            throw new \Exception("Model must be an instance of Illuminate\Database\Eloquent\Model.");
        }
        $this->info = is_string($model->visitLogs->ip_info)
            ? json_decode($model->visitLogs->ip_info, JSON_FORCE_OBJECT)
            : $model->visitLogs->ip_info;

        return $this;
    }
}