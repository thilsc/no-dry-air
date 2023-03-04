<?php

namespace Classes;

use Classes\Consts;
use Classes\Utils;

class Main {

    public static function execute()
    {
        try 
        {
            $localidade = 'SaoPaulo,br';

            $json = file_get_contents(Utils::montar_consulta($localidade));
    
            $data = json_decode($json, true);
    
            $humidity = $data['main']['humidity'];
    
            return "<h1>$localidade: $humidity%</h1>";            
        }
        catch (Exception $e) {
            die('Ocorreu um erro: '.$e->getMessage());
        }
    }

}

?>