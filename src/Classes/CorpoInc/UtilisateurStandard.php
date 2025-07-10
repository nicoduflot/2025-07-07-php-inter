<?php
namespace App\CorpoInc;
use App\CorpoInc\Utilisateur;

class UtilisateurStandard extends Utilisateur{
    protected $statut = 'utilisateur';

    public function getPermissions() : array {
        return ['lecture', 'modification_profil'];
    }
}