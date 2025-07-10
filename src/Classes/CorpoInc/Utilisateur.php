<?php
namespace App\CorpoInc;

abstract class Utilisateur{
    protected $login;
    protected $motdepasse;
    protected $statut;

    public function __construct($login, $motdepasse)
    {
        $this->login = $login;
        $this->motdepasse = password_hash($motdepasse, PASSWORD_DEFAULT);
    }

    public function getLogin() : string {
        return $this->login;
    }
    
    public function getStatut() : string {
        return $this->statut;
    }

    public function verifierMotDePasse($motdepasse): bool{
        return password_verify($motdepasse, $this->motdepasse);
    }

    abstract public function getPermissions();
}