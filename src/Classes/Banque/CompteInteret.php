<?php
namespace App\Banque;

class CompteInteret extends Compte{
    private $taux;
    public function __construct(
        $nom,
        $prenom,
        $numcompte,
        $numagence,
        $rib,
        $iban,
        $solde = 0,
        $taux = 0.03,
        $decouvert = 0,
        $devise ='€')
    {
        parent::__construct(
            $nom,
            $prenom,
            $numcompte,
            $numagence,
            $rib,
            $iban,
            $solde,
            $decouvert,
            $devise
        );
        $this->taux = $taux;
        $this->decouvert = 0;        
    }

    /**
     * Get the value of taux
     */ 
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * Set the value of taux
     *
     * @return  self
     */ 
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    public function crediterInterets() : string {
        $message = '';
        $interets = 0;
        if($this->getSolde() > 0){
            $interets = $this->getSolde()*$this->getTaux();
            $this->modifierSolde($interets);
            $message = 'Le compte à intérets à taux '. $this->getTaux()*100 . '% a été crédité de ' . $interets . ' ' . $this->getDevise() .'.<br />
            Solde créditeur : <b>'.$this->getSolde().' ' .$this->getDevise(). '</b>';
        }else{
            $message = 'Le compte à intérets à taux '. $this->getTaux()*100 . '% n\'a pas de crédit permettant le calcul des intérets.';
        }
        return $message;
    }

    public function infoCompte(): string
    {
        $message = parent::infoCompte();
        $message .= '<div class="my-2">Taux : <b>'.($this->getTaux()*100).' %</b></div>';
        return $message;
    }

    /*  méthode de sauvegarde du compte */

}