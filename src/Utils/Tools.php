<?php

namespace Utils;

use PDO;
use Exception;

/* Tools est une classe statique : pas de constructeur donc pas de création d'instance de la classe */

class Tools implements Config_Interface
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

    public static function setBdd($dbHost = self::DBHOST, $dbName = self::DBNAME, $dbUser = self::DBUSER, $dbPsw = self::DBPSW)
    {
        try {
            $bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=UTF8", $dbUser, $dbPsw, array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('<p>Erreur de connexion : ' . $e->getMessage() . '</p>');
        }
        return $bdd;
    }
    
    /**
     * Permet toutes les requête donnéesen BDD mais si c'est un insert, ne renvoie pas l'id du dernier éléments inserré
     * @param string $sql - requête sql en bindparam 
     * @param array $params : tableau des paramètres liés (bindparams)
     * @return mixed
     */
    public static function modBdd($sql, $params = []): mixed{
        $bdd = self::setBdd();
        $req = $bdd->prepare($sql);
        $req->execute($params);
        return $req;
    }

    /**
     * réservé à l'insertion car renvoi l'id de l'enregistrement créé dans la table
     * @param string $sql - requête sql en bindparam 
     * @param array $params : tableau des paramètres liés (bindparams)
     * @return mixed
     */
    public static function insertBdd($sql, $params = []): mixed{
        $bdd = self::setBdd();
        $req = $bdd->prepare($sql);
        $req->execute($params);
        return $bdd->lastInsertId();
    }

    public static function classActive($page) : string {
        return (basename($_SERVER['PHP_SELF']) === $page)?' active ': '';
    }

}