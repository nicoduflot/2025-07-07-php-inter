<?php
namespace App\CorpoInc;
use App\CorpoInc\Utilisateur;

class Editeur extends Utilisateur{
    protected $statut = 'editeur';

    public function getPermissions() : array {
        return ['lecture', 'ecriture', 'modification_contenu', 'modification_profil', 'publication'];
    }
}