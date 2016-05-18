<?php

namespace Application\Utils;

class StringConversion
{
    public static function indexToTitle($index)
    {
        //pegar indices tipo nome_fantasia
        //transformar em Nome Fantasia
        $title = '';
        if(strstr($index, '_')) {
            
            $arr = explode('_',$index);
            $n_arr = array_map(function($text){
                return ucfirst($text);
            }, $arr);
            $title = implode(' ', $n_arr);
        } else {
            $title = ucfirst($index);
        }
        return $title;
    }
    
    public static function titleToIndex($title)
    {
        //pegar titulos tipo Nome Fantasia
        //transformar em nome_fantasia
        $index = '';
        $title = strtolower($title);
        return preg_replace('/\s+/', '_', $title);
    }
}