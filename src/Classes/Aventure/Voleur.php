<?php
namespace JDR;
use JDR\Perso;

class Voleur extends Perso{
    public function __construct($nom)
    {
        parent::__construct($nom);
    }

    public function multi(Perso $cible){
        return $this->nom . ' tape par derrière le coquin '. $cible->nom . '<br />';
    }
}