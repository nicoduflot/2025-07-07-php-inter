<?php
session_start();
/* il faut charger la classe pour pouvoir utiliser l'objet */
require './src/Classes/Banque/Compte.php';
require './src/Utils/Tools.php';
/* Quand on déclare un namespace pour une classe, il faut expliquer que l'on utilise cette classe via le namespace */
use App\Banque\Compte;
use Utils\Tools;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Intermédiaire</title>
    <?php
    include './src/Utils/head.php';
    ?>
</head>
<body data-bs-theme="dark">
    <header>
        <div class="container">
            <h1>PHP Intermédiaire</h1>
        </div>
    </header>
    <div class="container">
        <?php include './src/Widgets/navbar.php'; ?>
    </div>
    <main class="container">
        <section>
            <article>
                <header>
                    <h2>Principes de la POO</h2>
                </header>
                <p>
                    Un objet est la réprésentation de quelque chose de matériel ou non à laquelle on associe des propriétés et des actions.
                </p>
                <p>
                    Une voiture, un compte bancaire, un personnage, etc peuvent être définis en tant qu'objets.
                </p>
                <p>
                    Un objet est défini par des attributs et des méthodes.
                </p>
                <h3>Attribut</h3>
                <p>
                    Les attributs sont des éléments ou caractères propres à l'objet.
                </p>
                <p>
                    Un compte bancaire, aura par exemple :
                </p>
                <ul>
                    <li>La civilité : nom, prénom du détenteur</li>
                    <li>le solde</li>
                    <li>le numéro d'agence</li>
                    <li>Le rib</li>
                    <li>l'iban</li>
                </ul>
                <h3>Les méthodes</h3>
                <p>
                    Les actions ou capacités applicable à l'objet.
                </p>
                <p>
                    Le compte bancaire de base aura comme méthodes :
                </p>
                <ul>
                    <li>Modifier le solde</li>
                    <li>Effectuer un virement vers un autre objet de type compte</li>
                    <li>Info sur le compte</li>
                </ul>
                <h3>Instance</h3>
                <p>
                    Un objet est une instance d'une classe. La classe défini l'objet, ses attributs et ses méthodes ainsi qu'un constructeur. C'est le constructeur qui gère la création de l'objet final.
                </p>
                <h3>Encapsulation</h3>
                <p>
                    Les attributs et les méthodes de l'objet sont donc encapsulés dans la classe. L'utilisateur de l'objet ne doit pas modifier le code de la classe mais utilisera l'objet via ses méthodes. En général il n'utilise pas directement ses attributs, ils seront <q>privés</q>
                </p>
                <h3>Créer la classe <q>Compte</q></h3>
                <p>
                    On crée les attributs en privé
                </p>
                <p>
                    On crée ensuite le <q>constructor</q>
                </p>
                <p>
                    Le constructeur sert a contruire l'objet lors de son instantiation. Il peut contenir du code et il définit les variables a renseigner lors de l'instanciation.
                </p>
                <p>
                    Comme les attributs sont privés, il faut, pour pouvoir les lire et / ou les modifier, créer des méthodes particulières, nommées getter ( ou Assesseur, pour les lire) et setter (ou Mutateur, pour les modifier).
                </p>
                <?php
                $monCompte = new Compte('Duflot', 'Nicolas', 'CCP-987654', '0123456', 'NOM RIB', 'MON IBAN FR', 2500, 400);
                var_dump($monCompte);
                var_dump($monCompte);
                var_dump($monCompte->getNom());
                var_dump($monCompte->setNom('Durand'));

                $compteDestinataire = new Compte('Magic', 'Eric', 'CCP-456789', '6543210', 'RIB ERIC', 'IBAN FR ERIC', 2500, 400);

                $monCompte->virement(400, $compteDestinataire);
                var_dump($monCompte->getSolde());
                var_dump($compteDestinataire->getSolde());
                echo $monCompte->typeCompte();
                echo $monCompte->infoCompte();
                ?>
                <h2>Les classes statiques</h2>
                <p>
                    Se sont des classes, généralement sans constructeur, qui contiennent une série de méthodes que l'on peut invoquer sans avoir besoin de créer une instance de la classe.
                </p>
                <p>
                    Il est d'ailleurs IMPOSSIBLE de créer une instance de classe si elle ne possèdent pas de constructeur
                </p>
                <?php
                echo Tools::$pi;
                ?>
            </article>
            <article>
                <header>
                    <h2>Le destructeur</h2>
                </header>
                <p>
                    La "vie" d'un objet est limité à l'éxécution de son script.
                    Il est possible de donner des instructions à l'objet juste avant sa destruction.
                </p>
                <p>
                    La méthode <code>__destruct(){}</code> se lance automatiquement quand un objet est détruit et s'éxécute juste avant sa déstruction complète. 
                    Cela est utiles dans les cas suivant : enregistrement des données de l'objet en BDD, en session
                </p>
            </article>
            <article>
                <header>
                    <h2>Un objet d'une page à l'autre ?</h2>
                </header>
                <p>
                    Donc si un objet est détruit d'une page à l'autre, comment peut-on "passer" cet objet ?
                </p>
                <h3>Serialize / unserialize</h3>
                <p>
                    En utilisant les session PHP, il est possible d'y enregistrer l'objet créé.
                </p>
                <p>
                    <code>$_SESSION['objetSession'] = serialize($objetScript);</code>
                </p>
                <?php
                $_SESSION['monCompte'] = serialize($monCompte);
                var_dump($_SESSION);
                ?>
                <p>
                    L'objet est donc enregistré ou "sérializé" dans la session PHP. Quand on arrive sur l'autre page, on peut donc récupérer cet objet de le "désérializant dans une variable"
                </p>
                <p>
                    <code>$objetScript = unserialize($_SESSION['objetSession']);</code>
                </p>
                <p>
                    En associant donc le destructeur avec l'enregistrement en session de l'objet, on peut donc créer un objet sur une page et l'utiliser sur les autres pages du site ou de l'application.
                </p>
            </article>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>
</html>