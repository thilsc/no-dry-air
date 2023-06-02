<?php

namespace Classes;

class LocalData {

    public string $city; 
    public string $state;
    public string $country;
    public float $latitude;
    public float $longitude;
    public array $local_names;

    public function __construct($api_response) {

        if(count($api_response) > 0)
        {
            $this->city      = $api_response[0]["name"];
            $this->state     = $api_response[0]["state"]; 
            $this->country   = $api_response[0]["country"];
            $this->latitude  = $api_response[0]["lat"] ?? 0.00;
            $this->longitude = $api_response[0]["lon"] ?? 0.00;
            $this->local_names = $api_response[0]["local_names"]?? [];
        }
    }

    function getFormattedLocation()
    {
        return $this->city . "," . $this->country;
    }

}