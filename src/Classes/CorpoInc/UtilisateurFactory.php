<?php
namespace App\CorpoInc;

use InvalidArgumentException;

require_once 'UtilisateurStandard.php';
require_once 'Editeur.php';
require_once 'Administrateur.php';

class UtilisateurFactory{
    public static function creer($type, $login, $motdepasse){
        switch(strtolower($type)){
            case 'utilisateur':
            case 'standard':
                return new UtilisateurStandard($login, $motdepasse);
            case 'admin':
            case 'administateur':
                return new Administrateur($login, $motdepasse);
            case 'editeur':
                return new Editeur($login, $motdepasse);
            default:
                throw new InvalidArgumentException('Type d\'utilisateur inconnu : '.$type.'<br />');
        }
    }
}