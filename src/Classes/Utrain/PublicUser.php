<?php
namespace App\Utrain;
require_once './src/Classes/Utrain/Utrain_Interface.php';
require_once './src/Classes/Utrain/Toto_Interface.php';

class PublicUser implements Utrain_Interface, Toto_Interface{
    protected $nomutilisateur;
    protected $statut;
    protected $prixabo;

    public function __construct($nom, $statut = ''){
        $this->nomutilisateur = $nom;
        $this->statut = $statut;
        $this->setPrixAbo();
    }

    public function getNomUtilisateur()
    {
        echo $this->nomutilisateur;
    }
    
    public function getPrixAbo()
    {
        echo $this->prixabo;
    }

    public function setPrixAbo()
    {
        if($this->statut === 'Pompier'){
            return $this->prixabo = Utrain_Interface::PRIXABO / 2;
        }else{
            return $this->prixabo = Utrain_Interface::PRIXABO;
        }
    }

    public function youpi(){
        echo Toto_Interface::TOCTOC;
    }
}