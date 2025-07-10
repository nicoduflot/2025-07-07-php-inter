<?php
namespace Utils;

interface Config_Interface{
    /* paramètres de la base de données */
    public const DBHOST ='';
    public const DBNAME ='';
    public const DBUSER ='';
    public const DBPSW ='';

    public const AUTOLOAD_ALIASES = [
        'App' => 'Classes',
        'JDR' => 'Classes\\Aventure',
        'App\\Banque' => 'Classes\\Banque',
        'App\\CorpoInc' => 'Classes\\CorpoInc',
        'App\\Utrain' => 'Classes\\Utrain',
        'Utils' => 'Utils'
    ];
}