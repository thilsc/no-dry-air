<?php

    $api_key = '4b04db5b8869e269ffda5cd57f3fbee8';

    $latitude = $_POST['location']['latitude'];
    $longitude= $_POST['location']['longitude'];

    $url_lat_lon = "http://api.openweathermap.org/geo/1.0/reverse?lat=$latitude&lon=$longitude&appid=$api_key";
    $lista_lat_lon = json_decode(file_get_contents($url_lat_lon), true);

    /*
        [
            {
                "country": "BR",
                "lat": -23.425269,
                "local_names": {
                    "bg": "Маринга",
                    "ja": "マリンガ",
                    "ko": "마링가",
                    "la": "Maringa",
                    "lt": "Maringa",
                    "mk": "Маринга",
                    "pt": "Maringá",
                    "ru": "Маринга",
                    "sr": "Маринга",
                    "zh": "馬林加"
                },
                "lon": -51.9382078,
                "name": "Maringá",
                "state": "Paraná"
            }
        ]
    */

    if (count($lista_lat_lon) > 0) 
    {
        $cidade = $lista_lat_lon[0]["name"];
        $estado = $lista_lat_lon[0]["state"];
        $pais   = $lista_lat_lon[0]["country"];
        $localidade = $cidade . "," . $pais;

        $url_lista_final = "https://api.openweathermap.org/data/2.5/weather?q=$localidade&appid=$api_key&units=metric";
        $lista_final = json_decode(file_get_contents($url_lista_final), true);

        /*
        https://api.openweathermap.org/data/2.5/weather?q=Maringá,BR&appid=4b04db5b8869e269ffda5cd57f3fbee8&units=metric
            {
                "base": "stations",
                "clouds": {
                    "all": 86
                },
                "cod": 200,
                "coord": {
                    "lat": -23.4253,
                    "lon": -51.9386
                },
                "dt": 1677906285,
                "id": 3457671,
                "main": {
                    "feels_like": 20.7,
                    "grnd_level": 949,
                    "humidity": 95,
                    "pressure": 1012,
                    "sea_level": 1012,
                    "temp": 20.15,
                    "temp_max": 20.15,
                    "temp_min": 20.15
                },
                "name": "Maringá",
                "sys": {
                    "country": "BR",
                    "sunrise": 1677921884,
                    "sunset": 1677966880
                },
                "timezone": -10800,
                "visibility": 10000,
                "weather": [
                    {
                        "description": "overcast clouds",
                        "icon": "04n",
                        "id": 804,
                        "main": "Clouds"
                    }
                ],
                "wind": {
                    "deg": 16,
                    "gust": 3.43,
                    "speed": 2.19
                }
            }
        */

        $humidity = $lista_final['main']['humidity'];
        $temp_min = $lista_final['main']['temp_min'];
        $temp_max = $lista_final['main']['temp_max'];

        echo "<h2 align=\"center\">$localidade</h2>";

        echo "<h4 align=\"center\">Umidade</h4>";
        echo "<h1 align=\"center\">$humidity%</h1>";

        echo "<h5 align=\"center\">Outros dados:</h5>";
        echo "<p align=\"center\"><b>Mín.</b> $temp_min<br><b>Máx.</b> $temp_max</p>";
    }

?>