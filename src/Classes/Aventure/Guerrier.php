<?php
namespace JDR;
require_once 'Perso.php';
use JDR\Perso;

class Guerrier extends Perso{
    public function __construct($nom)
    {
        parent::__construct($nom);
    }

    public function multi(Perso $cible){
        return $this->nom . ' tape super fort '. $cible->nom . '<br />';
    }
}