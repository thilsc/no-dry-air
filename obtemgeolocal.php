<?php
	
    require_once(__DIR__ . '/./vendor/autoload.php');

    use Classes\Utils;

    $html = Utils::getNullWeatherDataHTML();
    $location_name = '';

    if(isset($_POST['location_name'])) {
        
        $location_name = $_POST['location_name'];
        $weather_data = Utils::getLocalDataByName($location_name);
        $html = Utils::getWeatherDataHTML($weather_data);        
    }
    else
        if(isset($_POST['location'])) {
            $local_data = Utils::getLocalDataFromGeolocation($_POST['location']);

            if(isset($local_data)) {
                
                $location_name = $local_data->getFormattedLocation();
                $weather_data = Utils::getWeatherDataFromAPI($local_data);
                $html = Utils::getWeatherDataHTML($weather_data);
            }
        }
    
    $response = array("html" => $html, 
                      "location_name" => $location_name 
                     );
    echo json_encode($response);
?>