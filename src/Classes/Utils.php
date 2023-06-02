<?php

namespace Classes;

use Classes\Consts;
use Classes\LocalData;
use Classes\WeatherData;

class Utils 
{

public static function getCoordinatesAPIQuery($latitude, $longitude) {

    return "http://api.openweathermap.org/geo/1.0/reverse?".
           "lat=$latitude".
           "&lon=$longitude".
           "&appid=".Consts::API_KEY;
}

public static function getAPIQuery($local)
{
    return "https://api.openweathermap.org/data/2.5/weather?q=$local".
           "&appid=".Consts::API_KEY.
           "&units=".Consts::UNIDADE_MEDIDA;
}

public static function getLocalDataByName($location_name) {

    $api_response = json_decode(file_get_contents(self::getAPIQuery($location_name)), true);

    $ret = new WeatherData($api_response);

    return $ret;
}

public static function getLocalDataFromGeolocation($location) {

    $geolocation_data = Utils::getCurrentCoordinatesFromAPI($location['latitude'], $location['longitude']);

    if (count($geolocation_data) > 0) 
        return new LocalData($geolocation_data);
    else
        return null;
}

public static function getCurrentCoordinatesFromAPI($latitude, $longitude) {
   
    return json_decode(file_get_contents(self::getCoordinatesAPIQuery($latitude, $longitude)), true);
}

public static function getWeatherDataFromAPI(LocalData $local_data) {

    $api_response = json_decode(file_get_contents(self::getAPIQuery($local_data->getFormattedLocation())), true);

    $ret = new WeatherData($api_response);

    return $ret;
}

public static function getNullWeatherDataHTML() {

    return "<h2 align=\"center\">< local ></h2>" . 
           "<h4 align=\"center\">Umidade</h4>" . 
           "<h1 align=\"center\">0%</h1>" . 
           "<h4 align=\"center\"><b>Temperatura:</b>0</h4>" . 
           "<h4 align=\"center\"><b>Sensação térmica:</b>0</h4>";
}
public static function getWeatherDataHTML(WeatherData $weather_data) {
        
    return "<h2 align=\"center\">$weather_data->local</h2>" . 
           "<h4 align=\"center\">Umidade</h4>" . 
           "<h1 align=\"center\">$weather_data->humidity%</h1>" . 
           "<h4 align=\"center\"><b>Temperatura:</b>$weather_data->current_temp</h4>" . 
           "<h4 align=\"center\"><b>Sensação térmica:</b>$weather_data->feels_like</h4>";
}

}