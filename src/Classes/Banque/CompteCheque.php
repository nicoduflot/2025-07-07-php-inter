<?php
namespace App\Banque;
require 'Carte.php';
require 'Compte.php';
use App\Banque\Carte;

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
}