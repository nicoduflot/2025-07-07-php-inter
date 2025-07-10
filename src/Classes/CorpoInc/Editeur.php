<?php
namespace App\CorpoInc;
require_once 'Utilisateur.php';
use App\CorpoInc\Utilisateur;

class Editeur extends Utilisateur{
    protected $statut = 'editeur';

    public function getPermissions() : array {
        return ['lecture', 'ecriture', 'modification_contenu', 'modification_profil', 'publication'];
    }
}