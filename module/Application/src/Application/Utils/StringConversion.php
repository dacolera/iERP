<?php

namespace Application\Utils;

class StringConversion
{
    public static function indexToTitle($index)
    {
        //pegar indices tipo nome_fantasia
        //transformar em Nome Fantasia
        
        if(strstr('_', $index)) {
            $arr = explode('_',$index);
            array_filter($arr, function($text){
                return ucfirst($text);
            });
            $title = implode(' ', $arr);
        }
        return $title;
    }
}