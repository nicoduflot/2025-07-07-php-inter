<?php
namespace App\Banque;

use App\Banque\Carte;
use Utils\Tools;

class CompteCheque extends Compte{
    /* Attribut(s) propre(s) à CompteCheque */
    private $carte;
    /**
     * @param string $nom - le nom du détenteur du compte
     * @param string $prenom - le prénom du détenteur du compte
     * @param string $numcompte
     * @param string $numagence
     * @param string $rib
     * @param string $iban
     * @param string $numcarte
     * @param string $codepin
     * @param float $solde
     * @param float $decouvert
     * @param string $devise
     */
    public function __construct(
        $nom,
        $prenom,
        $numcompte,
        $numagence,
        $rib,
        $iban,
        $numcarte,
        $codepin,
        $solde = 0,
        $decouvert = 0,
        $devise ='€'
    ){
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
        $this->carte = new Carte($numcarte, $codepin);
    }

    /**
     * Get the value of carte
     */ 
    public function getCarte()
    {
        return $this->carte;
    }

    /* Les méthodes propres à CompteCheque */
    public function payerParCarte(string $numcarte, string $codepin, float $montant, Compte $destinataire): string{
        $message = '';

        if( $this->getCarte()->getNumcarte() ===  $numcarte && $this->getCarte()->getCodepin() ===  $codepin){
            if( $this->virement($montant, $destinataire) ){
                $etatSolde = ($this->getSolde() < 0)?' débiteur ': ' créditeur ';
                $message = '
                Un paiement de '.$montant.' '.$this->getDevise().' avec la carte '. $this->getCarte()->getNumcarte() .' a été effectué pour '. $destinataire->getNom() .'<br />
                Compte : '. $etatSolde .' : <b>'. $this->getSolde() .' '. $this->getDevise() .'</b>
                ';
            }
            return $message;
        }else{
            $message = 'Une erreur est survenue lors de la tentative de paiement de '.$montant.' vers le destinataire '.$destinataire->getNom().'.';
            return $message;
        }
    }

    public function infoCompte(): string
    {
        $infoCompte = parent::infoCompte();
        $infoCompte .= '<div class="my-2">Numéro de carte : <b>'.$this->getCarte()->getNumcarte().'</b></div>';
        return $infoCompte;
    }

    public static function generatePin() : string{
        $pin = ''.rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

        return $pin;
    }

    public static function generateCardNumber(): string{
        $numcarte = ''.
            self::generatePin(). ' '.
            self::generatePin(). ' '.
            self::generatePin(). ' '.
            self::generatePin()
        ;

        return $numcarte;
    }

    /* Méthodes de sauvegarde de l'objet en BDD */
    public function insertCompte() : bool {
        $cardid = $this->getCarte()->insertCard();
        $params = [
            'typecompte'=> $this->typeCompte(),
            'nom'=>$this->nom,
            'prenom'=> $this->prenom,
            'numcompte'=> $this->numcompte,
            'numagence'=> $this->numagence,
            'rib'=> $this->rib,
            'iban'=> $this->iban,
            'cardid' => $cardid,
            'solde'=> $this->solde,
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
                `cardid`,
                `solde`,
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
                :cardid,
                :solde,
                :devise,
                :decouvert
            );
        ';
        $this->id = Tools::insertBdd($sql, $params);
        return true;
    }
    
}