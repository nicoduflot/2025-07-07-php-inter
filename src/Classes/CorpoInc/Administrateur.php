<?php
namespace App\CorpoInc;
require_once 'Utilisateur.php';
use App\CorpoInc\Utilisateur;

class Administrateur extends Utilisateur{
    protected $statut = 'admin';

    public function getPermissions() : array {
        return ['lecture', 'ecriture', 'modification_contenu', 'modification_profil', 'publication', 'gestion_utilisateurs', 'administration'];
    }
}