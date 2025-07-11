<?php

namespace App\Banque;

class Compte{
    /* Attributs en privé */
    protected string $nom;
    protected string $prenom;
    protected string $numcompte;
    protected string $numagence;
    protected string $rib;
    protected string $iban;
    protected float $solde;
    protected float $decouvert;
    protected string $devise;

    /**
     * @param string $nom - le nom du détenteur du compte
     * @param string $prenom - le prénom du détenteur du compte
     * @param string $numcompte
     * @param string $numagence
     * @param string $rib
     * @param string $iban
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
        $solde = 0,
        $decouvert = 0,
        $devise ='€'
    )
    {
        /*
        il faut initialiser les attributs avec les paramètre en entré dnas le constructeur 
        les attributs sont des parties de l'objet
        le constructeur "appelle" ses propres attributs pour les initialiser
        $this : représente l'objet en son sein
        on "chaîne" le'attribut a instancier à l'objet
        $this->nom = $nom;
        */
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numcompte = $numcompte;
        $this->numagence = $numagence;
        $this->rib = $rib;
        $this->iban = $iban;
        $this->solde = $solde;
        $this->decouvert = $decouvert;
        $this->devise = $devise;
    }

    /*
    Les attributs déclarés en privé ou protégé ne sont pas accessible directement par l'instance de la classe
    Il faut créer des méthodes de type "assesseur" pour pouvoir soit les lire, soit les modifier

    accéder à un attribut : getter
    modifier un attribut  : setter

    */

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of numcompte
     */ 
    public function getNumcompte()
    {
        return $this->numcompte;
    }

    /**
     * Set the value of numcompte
     *
     * @return  self
     */ 
    public function setNumcompte($numcompte)
    {
        $this->numcompte = $numcompte;

        return $this;
    }

    /**
     * Get the value of numagence
     */ 
    public function getNumagence()
    {
        return $this->numagence;
    }

    /**
     * Set the value of numagence
     *
     * @return  self
     */ 
    public function setNumagence($numagence)
    {
        $this->numagence = $numagence;

        return $this;
    }

    /**
     * Get the value of rib
     */ 
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set the value of rib
     *
     * @return  self
     */ 
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get the value of iban
     */ 
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set the value of iban
     *
     * @return  self
     */ 
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get the value of solde
     */ 
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set the value of solde
     *
     * @return  self
     */ 
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get the value of decouvert
     */ 
    public function getDecouvert()
    {
        return $this->decouvert;
    }

    /**
     * Set the value of decouvert
     *
     * @return  self
     */ 
    public function setDecouvert($decouvert)
    {
        $this->decouvert = $decouvert;

        return $this;
    }

    /**
     * Get the value of devise
     */ 
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set the value of devise
     *
     * @return  self
     */ 
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /* Méthodes de l'objet */
    public function modifierSolde(float $montant): void{
        $this->setSolde($this->getSolde() + $montant);
    }

    public function virement($montant, Compte $destinataire){
        /* il faut vérifier que le montant est un nombre et supérieur à 0 */
        if( (!is_float($montant) && !is_int($montant)) || $montant <= 0 ){
            echo '<p>Le montant doit être un nombre supérieur à 0<br />Virement impossible vers le compte '
                    . $destinataire->getNumcompte() .'.</p>';
            return false;
        }
        echo $this->getSolde() - $montant.'<br />';
        /* il faut vérifier si le retrait du montant ne dépasse pas le découvert autorisé */
        if( $this->getSolde() - $montant < (-$this->getDecouvert()) ){
            echo '<p>Votre virement dépasse le dévcouvert autorisé de '. $this->getDecouvert() . ' ' . $this->getDevise() . '<br />Virement impossible vers le compte '
                    . $destinataire->getNumcompte() .'.</p>';
            return false;
        }
        $this->modifierSolde(-$montant);
        $destinataire->modifierSolde($montant);
        echo '<p>le compte ' . $destinataire->getNumcompte() .' a été crédité de '. $montant .' '. $this->getDevise() .'.</p>';
        return true;
    }

    public function typeCompte() : string {
        $className = get_class($this);
        return $className;
    }

    /**
     * @return string
     */
    public function infoCompte(): string {
        $ficheCompte = '';
        $etatSolde = ($this->getSolde() < 0)? 'débiteur': 'créditeur';
        $ficheCompte = '
            <div class="my-2"><b>'. $this->typeCompte() .'</b></div>
            <div class="my-2"><b>'. $this->getNom() . ' ' . $this->getPrenom() .'</b></div>
            <div class="my-2">Agence n° <b>'. $this->getNumagence() .'</b></div>
            <div class="my-2">RIB <b>'. $this->getRib() .'</b></div>
            <div class="my-2">IBAN <b>'. $this->getIban() .'</b></div>
            <div class="my-2">Compte '. $etatSolde .'<b> '. $this->getSolde() .' '. $this->getDevise() .'</b></div>
        ';
        return $ficheCompte;
    }

    /* Méthodes de sauvegarde de l'objet en BDD */

    

    /*  Méthode static de l'objet*/
    public static function helloWorld(){
        return 'Hello World';
    }

    /* 
    destructeur : une méthode qui s'éxécute uniquement lors de la destruction de l'objet 
    Par exemple quand on change de page et que l'objet n'est pas conservé d'une page à l'autre
    */

    public function __destruct()
    {
        // auto-sauvegarde de l'objet en bdd
    }
}