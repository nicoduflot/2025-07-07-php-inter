<?php
namespace App\Banque;

use Utils\Tools;

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

    /* Méthodes de sauvegarde de l'objet en BDD */
    public function insertCompte() : bool {
        $params = [
            'typecompte'=> $this->typeCompte(),
            'nom'=>$this->nom,
            'prenom'=> $this->prenom,
            'numcompte'=> $this->numcompte,
            'numagence'=> $this->numagence,
            'rib'=> $this->rib,
            'iban'=> $this->iban,
            'solde'=> $this->solde,
            'taux'=> $this->taux,
            'devise'=> $this->devise,
            'decouvert'=>$this->decouvert
        ];
        $sql = '
            INSERT INTO `compte` (
                `typecompte`,
                `nom`,
                `prenom`,
                `numcompte`,
                `numagence`,
                `rib`,
                `iban`,
                `solde`,
                `taux`,
                `devise`,
                `decouvert`
            ) VALUES (
                :typecompte,
                :nom,
                :prenom,
                :numcompte,
                :numagence,
                :rib,
                :iban,
                :solde,
                :taux,
                :devise,
                :decouvert
            );
        ';
        $this->id = Tools::insertBdd($sql, $params);
        return true;
    }

    public function majCompte() : bool {
        $params = [
            'id'=> $this->getId(),
            'nom'=>$this->nom,
            'prenom'=> $this->prenom,
            'numagence'=> $this->numagence,
            'solde'=> $this->solde,
            'taux'=> $this->taux,
        ];
        $sql = '
        UPDATE `compte` 
        SET 
            `id` = :id,
            `nom` = :nom,
            `prenom` = :prenom,
            `numagence` = :numagence,
            `solde` = :solde,
            `taux` = :taux

        WHERE 
            `id` = :id
        ';
        tools::modBdd($sql, $params);
        return true;
    }

}