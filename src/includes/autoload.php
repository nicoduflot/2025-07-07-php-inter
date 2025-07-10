<?php
/* il faut créer un mapping entre les namespace et la place physique des classes dans le projet */
/*const ALIASES = [
    'App' => 'Classes',
    'JDR' => 'Classes\\Aventure',
    'App\\Banque' => 'Classes\\Banque',
    'App\\CorpoInc' => 'Classes\\CorpoInc',
    'App\\Utrain' => 'Classes\\Utrain',
    'Utils' => 'Utils'
];*/

require_once './src/Utils/Config_interface.php';
use Utils\Config_Interface;

spl_autoload_register(function($classe){

    $namespaceparts = explode('\\', $classe);
    /*
    cas ou la classe est dans un répertoire direct
    ex :    Utils\Tools
            App\MonEXception

    cas ou la classe est dans un sous-répertoire
    ex :    App\Banque\Compte
            App\JDR\Monster\Small
    */

    $namespace = '';
    for($i = 0; $i < count($namespaceparts) - 1; $i++){
        if($i === 0){
            $namespace = $namespace.$namespaceparts[$i];
        }else{
            $namespace = $namespace.'\\'.$namespaceparts[$i];
        }
    }
    $classeName = $namespaceparts[count($namespaceparts)-1];

    if(array_key_exists($namespace, Config_Interface::AUTOLOAD_ALIASES)){
        $namespace = Config_Interface::AUTOLOAD_ALIASES[$namespace];
    }

    $paths = [
        join(DIRECTORY_SEPARATOR, [dirname(__DIR__), $namespace]),
        join(DIRECTORY_SEPARATOR, [__DIR__, '..', $namespace]),
        join(DIRECTORY_SEPARATOR, [__DIR__, $namespace]),
    ];

    foreach($paths as $path){
        $file = join(DIRECTORY_SEPARATOR, [$path, $classeName.'.php']);
        if(file_exists($file)){
            require_once $file;
            return true;
        }
    }

    return false;

});