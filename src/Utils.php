<?php

namespace Classes;

use Classes\Consts;

class Utils {

public static function montar_consulta($localidade)
{
    return "https://api.openweathermap.org/data/2.5/weather?q=$localidade".
           "&appid=".Consts::API_KEY.
           "&units=".Consts::UNIDADE_MEDIDA;
}



}