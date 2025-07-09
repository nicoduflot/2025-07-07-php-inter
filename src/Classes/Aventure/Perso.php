<?php

namespace JDR;

abstract class Perso{
    protected $nom;
    public function __construct($nom){
        $this->nom = $nom;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function taper(Perso $perso){
        return $this->nom . ' tape '. $perso->nom . '<br />';
    }

    abstract protected function multi(Perso $cible);
}