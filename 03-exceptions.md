# Support PHP Intermédiaire Programme 2025
Créé le 24 Juin 2025
## Table des matières

* [Retour au plan](./README.md)
* [Principes de la POO](./01-principes-de-la-poo.md)
* [Traitement des formulaires](./02-formulaires.md)
* [Exceptions](./03-exceptions.md)
* [PDO](./04-pdo.md)

# Exceptions
## Principes
Exception est une classe Php qui existe par défaut. Pour générer une exception dans un programme, il faut l'appeler à l'intéreur de la fonction a tester.

Exemple avec la fonction multiplier
```php
<?php
function multiplier($x, $y){
    if( !is_numeric($x) || !is_numeric($y) ){
        throw new Exception('Les deux valeurs doivent être numériques');
    }
    return $x * $y;
}
try{
    echo multiplier(20, 12).'<br />';
    echo multiplier("test", 23).'<br />';
    echo multiplier(113, 42).'<br />';
}catch(Exception $e){
    echo '<div class="alert alert-danger alert-dismissible fade show">
    Une exception a été lancée : <br />
    Message : '. $e->getMessage() .'<br />
    Code : '. $e->getCode() .'<br />
    File : '. $e->getFile() .'<br />
    Trace as string : '. $e->getTraceAsString() .'<br />
    Previous : '. $e->getPrevious() .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
?>
```
Avec le code suivant :

```php
<?php
echo multiplier(20, 12);
echo multiplier("test", 23);
echo multiplier(113, 42);
?>
```
**Résultat :**
```
240
Une exception a été lancée :
Message : Les deux valeurs doivent être numériques
Code : 0
File : D:\wamp64\www\039-php-intermediaire\exceptions.php
Trace as string : #0 D:\wamp64\www\039-php-intermediaire\exceptions.php(52): multiplier('test', 23) #1 {main}
Previous :
```
Si on n'utilise pas de try-catch sur des expression lançant des Exceptions, le reste du programme ne continue, ce qui génère des pages incomplètes.

Contrairement au premier exemple, le reste des instructions hors try s'exécutent normalement, donc le reste de la page s'affiche.

## Surcharger Exception : classe étendue personnelle
Comme Exception est une classe, il est donc possible de créer sa propre classe étendue d'Exception. En surchargeant les méthodes, on peut filtrer ou ne demander que ses propres exceptions. Par exemple, n'avoir que getMessage() au retour d'une exception.

```php
<?php
namespace App;

class MonException extends \Exception{
    private $toto;
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
        $this->toto = $code;
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
```

Avec le code suivant :

```php
<?php
function multiplier2($x, $y){
    if( !is_numeric($x) || !is_numeric($y) ){
        throw new MonException('Les deux valeurs doivent être numériques');
    }

    if( func_num_args() > 2){
        throw new Exception('La fonction n\'admet que deux paramètres');
    }

    return $x * $y;
}

try{
    echo multiplier2(15, 12).'<br />';
    echo multiplier2("test", 23).'<br />';
    echo multiplier2(113, 42).'<br />';
}catch(MonException $e2){
    echo '<div class="alert alert-info alert-dismissible fade show">
    Une MonException a été lancée : <br />
    Message : '. $e2->getMessage() .'<br />
    Code : '. $e2->getCode() .'<br />
    File : '. $e2->getFile() .'<br />
    Trace as string : '. $e2->getTraceAsString() .'<br />
    Previous : '. $e2->getPrevious() .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}catch(Exception $e){
    echo '<div class="alert alert-danger alert-dismissible fade show">
    Une exception classique a été lancée : <br />
    Message : '. $e->getMessage() .'<br />
    Code : '. $e->getCode() .'<br />
    File : '. $e->getFile() .'<br />
    Trace as string : '. $e->getTraceAsString() .'<br />
    Previous : '. $e->getPrevious() .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
```
**Résultat :**
```
180
Une MonException a été lancée :
Message : Les deux valeurs doivent être numériques
Code : 0
File : D:\wamp64\www\039-php-intermediaire\exceptions.php
Trace as string : #0 D:\wamp64\www\039-php-intermediaire\exceptions.php(96): multiplier2('test', 23) #1 {main}
Previous :
```
## Exception dans PDO
Il existe des exceptions pour PDO, mais elles ne sont pas natives dans Php, il faut les installer, il existe des dépendances sur packagist installable avec composer
```
composer require php-kit/ext-pdo
```
Ou bien de l'appeler dans le code comme ici : 

```php
<?php
try{
    $testBdd = new PDO('mysql:host=localhost;dbname=2024-07-08-php-avance;charset=UTF-8', 'root', '');
}catch(PDOException $e){
    echo '
    <div class="alert alert-warning alert-dismissible fade show">
    Une exception PDO a été lancée : <br />
    Message : '. $e->getMessage() .'<br />
    Line : '. $e->getLine() .'<br />
    Code : '. $e->getCode() .'<br />
    File : '. $e->getFile() .'<br />
    Trace as string : '. $e->getTraceAsString() .'<br />
    Previous : '. $e->getPrevious() .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
?>
```
**Résultat :**
```
Une exception PDO a été lancée :
Message : SQLSTATE[HY000] [2019] Unknown character set
Line : 133
Code : 2019
File : D:\wamp64\www\039-php-intermediaire\exceptions.php
Trace as string : #0 D:\wamp64\www\039-php-intermediaire\exceptions.php(133): PDO->__construct('mysql:host=loca...', 'root', Object(SensitiveParameterValue)) #1 {main}
Previous :
```