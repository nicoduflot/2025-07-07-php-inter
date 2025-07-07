# Support PHP Intermédiaire Programme 2025
Créé le 24 Juin 2025
## Table des matières

* [Retour au plan](./README.md)
* [Principes de la POO](./01-principes-de-la-poo.md)
* [Traitement des formulaires](./02-formulaires.md)
* [Exceptions](./03-exceptions.md)
* [PDO](./04-pdo.md)

# Classes étendues

## Principes

Une classe est étendue quand elle possède une classe fille. La classe fille hérite automatiquement des attributs et des méthodes de la classe mère. L'avantage est que la classe fille peut posséder ses propres méthodes et attributs, mais elle peut aussi surcharger les méthodes de la classe mère en les redéfinissants. Mais si on veut pouvoir redéfinir, par exemple, les getters ou setters de la classe mère, les attributs concernés dans la classe mère doivent être alors déclarés en protected et plus en private.

## Création des comptes qui héritent de la classe compte

On crée un compte chèque et un compte à intérêt.

### Le compte chèque
* Possède une carte de paiement
* Possède une méthode payerparcarte

### La carte de paiement
* Un numéro de carte
* Un PIN

### Le compte intérêts
* Possède un taux d'intérêt
* Possède une méthode crediterinterets
* Le virement ne permet pas de rendre débiteur le compteinteret

Pour utiliser le compte chèque, qui nécessite une carte, il faut tout d'abord créer la classe Carte

## Classe Carte

```php
<?php
namespace App\Banque;
use Utils\Tools;
class Carte{
    private $numcarte;
    private $codepin;

    /**
     * Carte constructor
     * @param string numcarte
     * @param string codepin
     */
    public function __construct($numcarte, $codepin){
        $this->numcarte = $numcarte;
        $this->codepin = $codepin;
    }

    /**
     * Get the value of numcarte
     */ 
    public function getNumcarte()
    {
        return $this->numcarte;
    }

    /**
     * Set the value of numcarte
     *
     * @return  self
     */ 
    public function setNumcarte($numcarte)
    {
        $this->numcarte = $numcarte;
        return $this;
    }

    /**
     * Get the value of codepin
     */ 
    public function getCodepin()
    {
        return $this->codepin;
    }

    /**
     * Set the value of codepin
     *
     * @return  self
     */ 
    public function setCodepin($codepin)
    {
        $this->codepin = $codepin;
        return $this;
    }
}
?>
```

## Classe compte chèque

```php
<?php
namespace App\Banque;
require 'Carte.php';
use App\Banque\Carte;
use Utils\Tools;

class CompteCheque extends Compte{
    /* Attributs particliers du compte chèque */
    private $carte;
    /**
     * @param string $nom - le nom du détenteur du compte
     * @param string $prenom - le prénom du détenteur du compte
     * @param string $numcompte - le numéro
     * @param string $numagence - 
     * @param string $rib - 
     * @param string $iban - 
     * @param string $numcarte
     * @param string $codepin
     * @param float  $solde - 
     * @param float  $decouvert - 
     * @param string $devise - 
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
        $devise = '€'
    )
    {
        parent::__construct($nom, $prenom, $numcompte, $numagence, $rib, $iban, $solde, $decouvert, $devise);
        $this->carte = new Carte($numcarte, $codepin);
    }

    /**
     * Get the value of carte
     */ 
    public function getCarte()
    {
        return $this->carte;
    }

    /* méthode(s) propre(s) à CompteCheque */
    /**
     * @param string $numcarte
     * @param string $codepin
     * @param float $montant
     * @param \App\Banque\Compte $destinataire
     */
    public function payerparcarte(string $numcarte, string $codepin, float $montant, Compte $destinataire){
        $message = '';
        if($this->getCarte()->getNumcarte() === $numcarte && $this->getCarte()->getCodepin() === $codepin){
            if($this->virement($montant, $destinataire)){
                $etatSolde = ($this->getSolde() < 0)? 'débiteur' : 'créditeur';
                $message = 'Un paiement de ' . $montant . $this->getDevise() . ' a été effectué vers le receveur '. $destinataire->getNom() .'<br />
                Compte ' . $etatSolde . ' : <b>' . $this->getSolde(). ' ' . $this->getDevise() . '</b>';
            }
            return $message;
        }else{
            $message = 'Une erreur est survenue lors de la tentative de paiement de ' . $montant . ' vers le destinataire <b>' . $destinataire->getNom() . '</b>.';
            return $message;
        }
    }

    public function ficheCompte(): string
    {
        $ficheCompte = parent::ficheCompte();
        $ficheCompte .= '<div class="my-2">Numéro de carte : <b>'.$this->getCarte()->getNumcarte().'</b></div>';
        return $ficheCompte;
    }

    public static function generatePin() : string{
        $pin = ''. rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return $pin;
    }

    public static function generateCardNumber() : string
    {
        $numcarte = ''  . CompteCheque::generatePin() . ' ' 
                        . CompteCheque::generatePin() . ' ' 
                        . CompteCheque::generatePin() . ' '
                        . CompteCheque::generatePin();
        
        return $numcarte;
    }
}
```

Avec les code suivant :
```php
<?php
/* ici on testera le compte chèque */
$comptecheque = new CompteCheque('Duflot', 'Nicolas', 'CCP-987654', '0123456', 'MON RIB', 'MON IBAN FR', '1236 4569 7854 9654', '0123', 2500, 400);
Tools::prePrint($comptecheque);
$comptechequeAcme = new CompteCheque('ACME', '', 'CCP-78954', '9876541', 'ACME RIB', 'ACME IBAN US', '9874 6541 3210 7854', '9874', 1000000, 40000);
Tools::prePrint($comptechequeAcme);
$comptecheque->virement(250, $comptechequeAcme);
echo $comptecheque->ficheCompte();
/*
$carteCompteCheque = $comptecheque->getCarte();
Tools::prePrint($carteCompteCheque);
*/
Tools::prePrint($comptecheque->getCarte());
Tools::prePrint($comptecheque->getCarte()->getCodepin());
Tools::prePrint($comptecheque->getCarte()->getNumcarte());
?>
```

Cela donne : 

```
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:
object(App\Banque\CompteCheque)[2]
  protected string 'nom' => string 'Duflot' (length=6)
  protected string 'prenom' => string 'Nicolas' (length=7)
  protected string 'numcompte' => string 'CCP-987654' (length=10)
  protected string 'numagence' => string '0123456' (length=7)
  protected string 'rib' => string 'MON RIB' (length=7)
  protected string 'iban' => string 'MON IBAN FR' (length=11)
  protected float 'solde' => float 2500
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 400
  protected string 'uniqueid' => string '' (length=0)
  private 'carte' => 
    object(App\Banque\Carte)[3]
      private 'numcarte' => string '1236 4569 7854 9654' (length=19)
      private 'codepin' => string '0123' (length=4)
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:
object(App\Banque\CompteCheque)[4]
  protected string 'nom' => string 'ACME' (length=4)
  protected string 'prenom' => string '' (length=0)
  protected string 'numcompte' => string 'CCP-78954' (length=9)
  protected string 'numagence' => string '9876541' (length=7)
  protected string 'rib' => string 'ACME RIB' (length=8)
  protected string 'iban' => string 'ACME IBAN US' (length=12)
  protected float 'solde' => float 1000000
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 40000
  protected string 'uniqueid' => string '' (length=0)
  private 'carte' => 
    object(App\Banque\Carte)[5]
      private 'numcarte' => string '9874 6541 3210 7854' (length=19)
      private 'codepin' => string '9874' (length=4)
```

Votre virement dépasse votre découvert autorisé de 400 €.


Virement impossible vers le compte n°CCP-78954.
CompteCheque
Duflot Nicolas
Agence n°0123456
RIB : MON RIB
IBAN : MON IBAN FR
Compte : créditeur 2500 €
Numéro de carte : 1236 4569 7854 9654

```
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:
object(App\Banque\Carte)[3]
  private 'numcarte' => string '1236 4569 7854 9654' (length=19)
  private 'codepin' => string '0123' (length=4)
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:string '0123' (length=4)
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:string '1236 4569 7854 9654' (length=19)
```

