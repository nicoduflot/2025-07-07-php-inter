<?php

namespace Utils;

use PDO;
use Exception;

/* Tools est une classe statique : pas de constructeur donc pas de création d'instance de la classe */

class Tools
{

    static $pi = 3.1415926535898;

    public static function circo($rayon)
    {
        return (2 * $rayon) * self::$pi;
    }

    public static function makeSlug($text)
    {
        /* convertir en minuscule */
        $text = strtolower($text);

        /* remplacer les caractères accentués */
        $text = preg_replace(
            array('/&.*;/', '/\W/'),
            '-',
            preg_replace(
                '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/',
                '$1',
                htmlentities($text, ENT_NOQUOTES, 'UTF-8')
            )
        );

        /* tirets multiples */
        $text = preg_replace('/-+/', '-', $text);

        /* retirer les tirets en début et fin de chaîne */
        $text = trim($text, '-');

        return $text;
    }

    /* outil d'affichage de données "brutes" */
    public static function prePrint($data)
    {
        echo '<code style="font-size: 1rem"><pre>';
        var_dump($data);
        echo '</pre></code>';
    }

    public static function setBdd($dbHost = 'localhost', $dbName = '2025-07-07-php-inter', $dbUser = 'root', $dbPsw = '')
    {
        try {
            $bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=UTF8", $dbUser, $dbPsw, array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('<p>Erreur de connexion : ' . $e->getMessage() . '</p>');
        }
        return $bdd;
    }

    public static function modBdd($sql, $params = []){
        $bdd = self::setBdd();
        $req = $bdd->prepare($sql);
        $req->execute($params);
        return $req;
    }
}