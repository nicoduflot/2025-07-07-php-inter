<?php
namespace App\Utrain;

use App\Utrain\Utrain_Interface;
class InternUser implements Utrain_Interface{
   protected $nomUtilisateur;
   protected $statut;
   protected $prixAbo;

   public function __construct($nom, $statut = ''){
        $this->nomUtilisateur = $nom;
        $this->statut = $statut;
        $this->setPrixAbo();
   }
    public function getNomUtilisateur(){
        echo $this->nomUtilisateur;
    }
    public function getPrixAbo(){
        echo $this->prixAbo;
    }
    public function setPrixAbo(){
        if($this->statut === 'Cadre'){
            return $this->prixAbo = Utrain_Interface::PRIXABO / 6;
        }else{
            return $this->prixAbo = Utrain_Interface::PRIXABO / 3;
        }
    }

    public function getWifi(){
        echo 'L\'utilisateur du transport a le wifi sans pub';
    }
}