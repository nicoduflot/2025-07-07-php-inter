# Support PHP Intermédiaire Programme 2025
Créé le 24 Juin 2025
## Table des matières

* [Retour au plan](./README.md)
* [Principes de la POO](./01-principes-de-la-poo.md)
* [Traitement des formulaires](./02-formulaires.md)
* [Exceptions](./03-exceptions.md)
* [PDO](./04-pdo.md)

# Principes de la POO
Un objet est la réprésentation de quelque chose de matériel ou non à laquelle on associe des propriétés et des actions.

Une voiture, un compte bancaire, un personnage, etc peuvent être définis en tant qu'objets.

Un objet est défini par des attributs et des méthodes.

On crée un objet à l'aide d'une classe

## Les composants des classes

### Attribut
Les attributs sont des éléments ou caractères propres à l'objet.

Un compte bancaire, aura par exemple :

La civilité : nom, prénom du détenteur
le solde
le numéro d'agence
Le rib
l'iban
### Les méthodes
Les actions ou capacités applicable à l'objet.

Le compte bancaire de base aura comme méthodes :

Modifier le solde
Effectuer un virement vers un autre objet de type compte
Info sur le compte
### Instance
Un objet est une instance d'une classe. La classe défini l'objet, ses attributs et ses méthodes ainsi qu'un constructeur. C'est le constructeur qui gère la création de l'objet final.

### Encapsulation
Les attributs et les méthodes de l'objet sont donc encapsulés dans la classe. L'utilisateur de l'objet ne doit pas modifier le code de la classe mais utilisera l'objet via ses méthodes. En général il n'utilise pas directement ses attributs, ils seront privés

## Créer la classe Compte
On crée les attributs en privé

On crée ensuite le constructor

Le constructeur sert a contruire l'objet lors de son instantiation. Il peut contenir du code et il définit les variables a renseigner lors de l'instanciation.

Comme les attributs sont privés, il faut, pour pouvoir les lire et / ou les modifier, créer des méthodes particulières, nommées getter ( ou Assesseur, pour les lire) et setter (ou Mutateur, pour les modifier).

```php
<?php
namespace App\Banque;
class Compte{
    /* Attributs en protected */
    protected string $nom;
    protected string $prenom;
    protected string $numcompte;
    protected string $numagence;
    protected string $rib;
    protected string $iban;
    protected float $solde;
    protected string $devise;
    protected float $decouvert;
    protected string $uniqueid;
    /* 
    Ici les attributs sont protected
    Quand un attribut est public, il est accessible directement depuis l'objet créé
    $objet->attribut;
    Quand un attribut est private, il pour y accéder (le récupérer ou le modifier),
    il faut créer des assesseurs. 
    Ce sont des méthodes qui, si elle sont écrites, permettent d'utiliser les attributs privés
    $objet->getObjet() //renvoi l'objet, il s'agit d'un getter
    $objet->setObjet($valeur) // va modifier l'objet, il s'agit d'un setter
    Un attribut private n'est pas utilisable directement par une classe enfant, 
    la classe enfant dera elle aussi utiliser les assesseurs de la classe parente s'ils existent.
    Un attribut en protected agit presque exactement comme un attribut en privé, 
    sauf que l'attribut sera directement utilisable par les classes enfants sans passer par des assesseurs de la classe parent
    */

    /* 
    pour pouvoir utiliser la classe, créer une instance de la classe, il faut contruire l'objet 
    Quand on invoque la classe, on appelle la méthode qui est le constructeur de l'objet
    */
    /*
    @param indique en annotation à l'utilisateur de la classe quels sont les paramètre à indiquer pour voir utiliser cette classe et surtout de quel type (int, string, etc) le paramètre doit être pour que la classe s'instancie correctement
    */
    /**
     * @param string $nom - le nom du détenteur du compte
     * @param string $prenom - le prénom du détenteur du compte
     * @param string $numcompte - le numéro
     * @param string $numagence - 
     * @param string $rib - 
     * @param string $iban - 
     * @param float  $solde - 
     * @param string $devise - 
     * @param float  $decouvert - 
     * @param string $uniqueid - 
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
        $devise = '€',
        $uniqueid = ''
        ){
        /* $this : dans cet objet que je crée */
        /* -> je cherche l'attribut ou la méthode nommé  */
        /* ici c'est l'attribut nom */
        /* que j'instancie avec la variable $nom envoyé par l'invocation de la classe */
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numcompte = $numcompte;
        $this->numagence = $numagence;
        $this->rib = $rib;
        $this->iban = $iban;
        $this->solde = $solde;
        $this->decouvert = $decouvert;
        $this->devise = $devise;
        $this->uniqueid = $uniqueid;
    }

    /* les assesseurs des attributs protected */
    


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
     * Get the value of uniqueid
     */ 
    public function getUniqueid()
    {
        return $this->uniqueid;
    }

    /**
     * Set the value of uniqueid
     *
     * @return  self
     */ 
    public function setUniqueid($uniqueid)
    {
        $this->uniqueid = $uniqueid;

        return $this;
    }

    /* les méthodes propres à tous les type de compte */
    public function modifierSolde($montant){
        $this->setSolde($this->getSolde() + $montant);
    }

    /**
     * @param float $montant - montant positif et entier ou flottant de la transaction
     * @param object $destinataire - objet instance de la classe Compte
     */
    public function virement($montant, Compte $destinataire){
        if( (!is_float($montant) && !is_int($montant) ) && $montant <= 0 ){
            echo '<p>Le montant doit être un chiffre supérieur à 0</p>
            <br />Virement impossible vers le compte n°'.$destinataire->getNumcompte(). '.';
            return false;
        }
        if( ($this->getSolde() - $montant) > ($this->getDecouvert()) ){
            echo '<p>Votre virement dépasse votre découvert autorisé de '. $this->getDecouvert(). ' '.$this->getDevise().'.</p>
            <br />Virement impossible vers le compte n°'.$destinataire->getNumcompte(). '.';
            return false;
        }
        $this->modifierSolde(-$montant);
        $destinataire->modifierSolde($montant);
        echo 'Le compte n°'.$destinataire->getNumcompte(). ' a été crédité de '.$montant. ' ' .$this->getDevise() .'.';
        /* Mise à jour du solde du compte dans la BDD */
        return true;
    }

    public function typeCompte() : string{
        $className = get_class($this);
        $nameSpace = __NAMESPACE__.'\\';
        $className = str_replace($nameSpace, '', $className);
        return $className;
    }

    /**
     * @return string
     */
    public function infoCompte() : string {
        $ficheCompte = '';
        /* on utilise un ternaire pour définir l'état du solde créditeur ou débiteur */
        $etatSolde = ( $this->getSolde() < 0 )? 'débiteur':'créditeur';
        $ficheCompte = '
        <div>
        <div class="my-2"><b>'.$this->typeCompte().'</b></div>
        <div class="my-2"><b>'.$this->getNom(). ' '. $this->getPrenom() .'</b></div>
        <div class="my-2">Agence n°<b>'.$this->getNumagence().'</b></div>
        <div class="my-2">RIB : <b>'.$this->getRib().'</b></div>
        <div class="my-2">IBAN : <b>'.$this->getIban().'</b></div>
        <div class="my-2">Compte : '. $etatSolde .' <b>' .$this->getSolde(). ' ' . $this->getDevise() . '</b></div>';
        $ficheCompte .='</div>';
        return $ficheCompte;
    }

    /**
     * @return string
     */
    public function ficheCompte() : string {
        $ficheCompte = '';
        /* on utilise un ternaire pour définir l'état du solde créditeur ou débiteur */
        $etatSolde = ( $this->getSolde() < 0 )? 'débiteur':'créditeur';
        $ficheCompte = '
        <div class="my-2"><b>'.$this->typeCompte().'</b></div>
        <div class="my-2"><b>'.$this->getNom(). ' '. $this->getPrenom() .'</b></div>
        <div class="my-2">Agence n°<b>'.$this->getNumagence().'</b></div>
        <div class="my-2">RIB : <b>'.$this->getRib().'</b></div>
        <div class="my-2">IBAN : <b>'.$this->getIban().'</b></div>
        <div class="my-2">Compte : '. $etatSolde .' <b>' .$this->getSolde(). ' ' . $this->getDevise() . '</b></div>';
        return $ficheCompte;
    }    
}
```

### Charger les classes

pour pouvoir utiliser les classes, il faut les requerir en début de page

```php
// appel des classes
require './src/Classes/Banque/Compte.php';
require './src/Utils/Tools.php';
// Dès qu'on utilise une classe
// on l'appelle en n'oubliant pas le namespace
use App\Banque\Compte;
use Utils\Tools;
```

### Utiliser Compte

Le code suivant : 
```php
<?php
$compte = new Compte('Duflot', 'Nicolas', 'CCP-987654', '0123456', 'MON RIB', 'MON IBAN FR', 2500, 400);
var_dump($compte);
var_dump($compte->getNom());
var_dump($compte->setPrenom('Doudou'));
$compte->modifierSolde(-52);
var_dump($compte->getSolde());
$compteDestinataire = new Compte('Dusse', 'Jean-claude', 'CCP-0123456', '987656', 'SON RIB', 'SON IBAN FR', 1500);
var_dump($compteDestinataire);
var_dump($compte->virement(2500, $compteDestinataire));
var_dump($compte);
var_dump($compteDestinataire);
var_dump($compte->typeCompte());
echo $compte->ficheCompte();
?>
```

Donne : 

```
D:\wamp64\www\039-php-intermediaire\index.php:98:
object(App\Banque\Compte)[2]
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
D:\wamp64\www\039-php-intermediaire\index.php:99:string 'Duflot' (length=6)
D:\wamp64\www\039-php-intermediaire\index.php:100:
object(App\Banque\Compte)[2]
  protected string 'nom' => string 'Duflot' (length=6)
  protected string 'prenom' => string 'Doudou' (length=6)
  protected string 'numcompte' => string 'CCP-987654' (length=10)
  protected string 'numagence' => string '0123456' (length=7)
  protected string 'rib' => string 'MON RIB' (length=7)
  protected string 'iban' => string 'MON IBAN FR' (length=11)
  protected float 'solde' => float 2500
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 400
  protected string 'uniqueid' => string '' (length=0)
D:\wamp64\www\039-php-intermediaire\index.php:102:float 2448
D:\wamp64\www\039-php-intermediaire\index.php:104:
object(App\Banque\Compte)[3]
  protected string 'nom' => string 'Dusse' (length=5)
  protected string 'prenom' => string 'Jean-claude' (length=11)
  protected string 'numcompte' => string 'CCP-0123456' (length=11)
  protected string 'numagence' => string '987656' (length=6)
  protected string 'rib' => string 'SON RIB' (length=7)
  protected string 'iban' => string 'SON IBAN FR' (length=11)
  protected float 'solde' => float 1500
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 0
  protected string 'uniqueid' => string '' (length=0)
Le compte n°CCP-0123456 a été crédité de 2500 €.
D:\wamp64\www\039-php-intermediaire\index.php:105:boolean true
D:\wamp64\www\039-php-intermediaire\index.php:106:
object(App\Banque\Compte)[2]
  protected string 'nom' => string 'Duflot' (length=6)
  protected string 'prenom' => string 'Doudou' (length=6)
  protected string 'numcompte' => string 'CCP-987654' (length=10)
  protected string 'numagence' => string '0123456' (length=7)
  protected string 'rib' => string 'MON RIB' (length=7)
  protected string 'iban' => string 'MON IBAN FR' (length=11)
  protected float 'solde' => float -52
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 400
  protected string 'uniqueid' => string '' (length=0)
D:\wamp64\www\039-php-intermediaire\index.php:107:
object(App\Banque\Compte)[3]
  protected string 'nom' => string 'Dusse' (length=5)
  protected string 'prenom' => string 'Jean-claude' (length=11)
  protected string 'numcompte' => string 'CCP-0123456' (length=11)
  protected string 'numagence' => string '987656' (length=6)
  protected string 'rib' => string 'SON RIB' (length=7)
  protected string 'iban' => string 'SON IBAN FR' (length=11)
  protected float 'solde' => float 4000
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 0
  protected string 'uniqueid' => string '' (length=0)
D:\wamp64\www\039-php-intermediaire\index.php:108:string 'Compte' (length=6)
```
Compte
Duflot Doudou
Agence n°0123456
RIB : MON RIB
IBAN : MON IBAN FR
Compte : débiteur -52 €

## Les classes statiques
Se sont des classes, généralement sans constructeur, qui contiennent une série de méthodes que l'on peut invoquer sans avoir besoin de créer une instance de la classe.

Il est d'ailleurs IMPOSSIBLE de créer une instance de classe si elle ne possèdent pas de constructeur

### Classe statique Tools
```php
<?php
// Tools.php
namespace Utils;

/* Tools sera une classe statique : pas de constructeur => on ne créera pas d'instance de cette classe */

class Tools{
    static $pi = 3.1415926535898;

    public static function prePrint($data){
        echo '<code>';
        var_dump($data);
        echo '</pre></code>';
    }
}
```

Le code suivant donne :

```php
<?php
/* accès à un attribut statique */
echo Tools::$pi.'<br />';
/* accès à une méthode statique */
Tools::prePrint($compte);
?>
```


```
3.1415926535898
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:
object(App\Banque\Compte)[2]
  protected string 'nom' => string 'Duflot' (length=6)
  protected string 'prenom' => string 'Doudou' (length=6)
  protected string 'numcompte' => string 'CCP-987654' (length=10)
  protected string 'numagence' => string '0123456' (length=7)
  protected string 'rib' => string 'MON RIB' (length=7)
  protected string 'iban' => string 'MON IBAN FR' (length=11)
  protected float 'solde' => float -52
  protected string 'devise' => string '€' (length=3)
  protected float 'decouvert' => float 400
  protected string 'uniqueid' => string '' (length=0)
  ```
### Le destructeur
La "vie" d'un objet est limité à l'éxécution de son script. Il est possible de donner des instructions à l'objet juste avant sa destruction.

La méthode ```__destruct(){}``` se lance automatiquement quand un objet est détruit et s'éxécute juste avant sa déstruction complète. Cela est utiles dans les cas suivant : enregistrement des données de l'objet en BDD, en session

### Un objet d'une page à l'autre ?
Donc si un objet est détruit d'une page à l'autre, comment peut-on "passer" cet objet ?

Serialize / unserialize
En utilisant les session PHP, il est possible d'y enregistrer l'objet créé.

```$_SESSION['objetSession'] = serialize($objetScript);```

L'objet est donc enregistré ou "sérializé" dans la session PHP. Quand on arrive sur l'autre page, on peut donc récupérer cet objet de le "désérializant dans une variable"

```$objetScript = unserialize($_SESSION['objetSession']);```

En associant donc le destructeur avec l'enregistrement en session de l'objet, on peut donc créer un objet sur une page et l'utiliser sur les autres pages du site ou de l'application.

### Autoload

Il est possible de créer un fichier qui permet de charger automatiquement les classes qui seraient appelées via ```use```.

```php
<?php
//autoload.php
/* Le tableau suivant permet d'indiquer les alias des namespace et des chemins physiques des classes */
const ALIASES = [
    'App\\Banque'   => 'Classes\\Banque',
    'App'   => 'Classes',
    'Utils'     => 'Utils'
];
/**
 * pour le coup ici le namespace Utils est dans le répertoire CLasses comme le namespace Classes
 */
spl_autoload_register(function($classe){
    $namespaceParts = explode('\\', $classe);
    if(count($namespaceParts) > 2){
        
        $namespace = '';
        for($i = 0; $i < count($namespaceParts)-1; $i++){
        
            if($i === 0){
                $namespace = $namespace.$namespaceParts[$i];
            }else{
                $namespace = $namespace.'\\'.$namespaceParts[$i];
            }
        }
        $classeName = $namespaceParts[count($namespaceParts)-1];
    }else{
        $namespace = $namespaceParts[0];
        $classeName = $namespaceParts[1];
    }

    if( array_key_exists($namespace, ALIASES) ){
        $namespace = ALIASES[$namespace];
    }

    $paths = [
        join(DIRECTORY_SEPARATOR, [dirname(__DIR__), $namespace]),
        join(DIRECTORY_SEPARATOR, [__DIR__, '..', $namespace]),
        join(DIRECTORY_SEPARATOR, [__DIR__, $namespace])
    ];

    //var_dump(($paths));

    foreach($paths as $path ){
        $file = join(DIRECTORY_SEPARATOR, [$path, $classeName.'.php']);
        if(file_exists($file)){
            //echo $file.' trouvé<br />';
            require_once $file;
            return true;
        }else{
            echo $file.' n\'existe pas où n\'est pas dans le bon répertoire';
        }
    }
    echo $classe.' n\'a été trouvé dans aucun chemin';

    return false;
});
```

Et on l'utiliser en début de fichier

```php
include './src/includes/autoload.php';
/* une fois la classe chargée, il faut indiquer qu'on l'utilise */
/* on indique le namespace de la classe puis sont nom de classe */
use App\Banque\Compte;
use Utils\Tools;
```