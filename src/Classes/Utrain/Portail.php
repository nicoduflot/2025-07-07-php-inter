<?php
namespace App\Utrain;

class Portail implements Utrain_Interface{

    protected $nomutilisateur;
    protected $statut;
    protected $prixabo;
    protected $datelimite;

    public function __construct($nom, $statut = '', $date = ''){
        $this->nomutilisateur = $nom;
        $this->statut = $statut;
        $this->datelimite = $date;
    }

    public function getNomUtilisateur()
    {
        //vérification de l'abonnement qui existe
    }
    
    public function getPrixAbo()
    {
        // verification de l'abonnement payé
    }

    public function setPrixAbo()
    {
        $this->getPrixAbo();
    }

    public function checkValidity($datenow) : bool {
        /* 
        retourne vrai si abonnement valide sinon faux
        */

        return false;
    }
}