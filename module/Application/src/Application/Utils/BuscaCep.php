<?php

namespace Application\Utils;

use Application\Model\HttpClient;

class BuscaCep
{
    private static $resource = 'http://1link.com.br/cep/encontraCep.php?cep=';
    
    public static function retrieve($cep)
    {
        $ch = curl_init();
        
        curl_setopt ($ch , CURLOPT_URL , self::$resource . $cep);
        curl_setopt ($ch , CURLOPT_RETURNTRANSFER , true);
        
        $resposta = curl_exec($ch);
        curl_close($ch);
        
        return self::formataSaida($resposta);    
    }
    
    private static function formataSaida($response)
    {
        if (!$response) {
            throw new \Excepion('Erro no curl');
        }
        $matches = explode('&', $response);
        $r = [];
        foreach($matches as $match) {
            $items = explode('=', $match);
            if ($items[0]) {
                $r[$items[0]] = $items[1];
        
            }    
        }
        return $r;
    }
}