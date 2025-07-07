<?php
namespace Utils;

/* Tools est une classe statique : pas de constructeur donc pas de création d'instance de la classe */

class Tools{
    
    static $pi = 3.1415926535898;

    public static function circo($rayon){
        return (2*$rayon) * self::$pi;
    }
}