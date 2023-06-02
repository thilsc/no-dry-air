<?php

namespace Classes;

class WeatherData {

    public string $local;
    public int $humidity;
    public float $current_temp;
    public float $feels_like;

    public function __construct($api_response) {

        $this->local        = $api_response["name"].",".$api_response["sys"]["country"];
        $this->humidity     = $api_response["main"]['humidity'] ?? 0;
        $this->current_temp = $api_response["main"]['temp_max'] ?? 0.0;
        $this->feels_like   = $api_response["main"]['feels_like'] ?? 0.0;
    }
}

?>