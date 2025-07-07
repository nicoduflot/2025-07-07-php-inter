# Support PHP Intermédiaire Programme 2025
Créé le 24 Juin 2025
## Table des matières

* [Retour au plan](./README.md)
* [Principes de la POO](./01-principes-de-la-poo.md)
* [Traitement des formulaires](./02-formulaires.md)
* [Exceptions](./03-exceptions.md)
* [PDO](./04-pdo.md)

# Traitement des formulaires
Les formulaires servent a récupérer des informations pour traitement, par exemple, un serveur php qui pourra les enregistrer en fichier, en bdd, ou les envoyer par mail.

Un formulaire se déclare à l'aide de la balise form. Il possède des attributs, dont les plus courants et importants sont : method & action

## method
C'est la méthode d'envoi des informations du formulaire, il en existe deux :

GET : les données sont envoyées associées à des noms de variables dans l'url de la page de traitement
POST : Les données sont transmises en variables dans l'entête HTTP.
Si la méthode n'est pas indiquée dans le formulaire, c'est GET qui sera utilisé par défaut

## Action
<div class="alert alert-warning">Indique l'url de la page de traitement des données envoyées par le formulaire. Si action n'est pas précisé, le formulaire considère que c'est la page où il se trouve qui sera la page de traitement.</div>

# Les fichiers
## Ouverture et fermeture d'un fichier
fopen() et fclose()
```php
<?php
if (!$monFichierTexte = fopen("./files/file.txt", "r")) {
    echo "Echec de l'ouverture du fichier<br />";
} else {
    echo "fichier ouvert<br />";
    fclose($monFichierTexte);
}
?>
```
**Résultat :**
```fichier ouvert```

## Lire un fichier
fread()

```php
<?php
if (!$monFichierTexte = fopen("./files/file.txt", "r")) {
    echo "Echec de l'ouverture du fichier<br />";
} else {
    echo "fichier ouvert<br />";
    fclose($monFichierTexte);
}
?>
```
**Résultat :**
```
fichier ouvert
D:\wamp64\www\039-php-intermediaire\src\Utils\Tools.php:14:string 'Terry Pratchett [ˈtɛɹi ˈpɹæt͡ʃɪt]1, né le 28 avril 1948 à Beaconsfield (Buckinghamshire) 
et mort le 12 mars 2015 à Broad Chalke (Wiltshire)2, est un écrivain britannique. 
Il est principalement connu pour ses romans de fantasy humoristique prenant place 
dans l'univers du Disque-monde, dans lequel il détourne les canons du genre pour 
se livrer à une satire de divers aspects de la société contemporaine.

Pratchett publie son premier roman en 1971, mais ce n'est qu'en 1983 qu'il renco'... (length=1386)
```


## Lire un fichier en parcellaire fgets()
```php
<?php
if (!$monFichierTexte = fopen("./files/file.txt", "r")) {
    echo "Echec de l'ouverture du fichier<br />";
} else {
    echo "fichier ouvert<br />";
    echo "<p>";
    //prePrint(fread($monFichierTexte, filesize("./files/file.txt")));
    echo fgets($monFichierTexte) . "<br />";
    echo fgets($monFichierTexte, 10) . "<br />";
    echo fgets($monFichierTexte) . "<br />";
    //lecture d'un fichier avec fgets et une boulce en utilisant feof() => fin de fichier
    while (!feof($monFichierTexte)) {
        echo fgets($monFichierTexte) . "<br />";
    }
    echo "</p>";
    fclose($monFichierTexte);
}
?>
```

**Résultat :**
```
fichier ouvert
Terry Pratchett [ˈtɛɹi ˈpɹæt͡ʃɪt]1, né le 28 avril 1948 à Beaconsfield (Buckinghamshire)
et mort l
e 12 mars 2015 à Broad Chalke (Wiltshire)2, est un écrivain britannique.
Il est principalement connu pour ses romans de fantasy humoristique prenant place
dans l'univers du Disque-monde, dans lequel il détourne les canons du genre pour
se livrer à une satire de divers aspects de la société contemporaine.

Pratchett publie son premier roman en 1971, mais ce n'est qu'en 1983 qu'il rencontre
vraiment le succès avec le premier volume des Annales du Disque-monde. Il devient par
la suite l'un des auteurs de fantasy les plus prolifiques (les Annales comptent plus
de trente tomes) et les plus appréciés. Ses livres se sont vendus à plus de 85 millions
d'exemplaires dans 37 langues. Pratchett est ainsi l'auteur britannique le plus vendu
des années 1990. Selon un sondage publié en 2006 dans le magazine littéraire britannique
Book Magazine, Terry Pratchett est alors le second auteur vivant le plus apprécié de ses
compatriotes, derrière J. K. Rowling.

Il est anobli par la reine en 2008, et reçoit de nombreuses récompenses pour son œuvre.
Atteint d'une forme rare de la maladie d'Alzheimer, il milite pendant ses dernières années
en faveur du droit au suicide assisté, notamment dans son documentaire Choosing to Die (en).
```
## Créer des fichiers
Depuis un formulaire contenant un champ titre et un champ message, ainsi que deux boutons dont celui de validation du formulaire nommé ```createFile``` contenant la valeur ```Envoyer```

```php
if (isset($_POST["createFile"]) && $_POST["createFile"] === "Envoyer") {
    if ($_POST["titre"] !== "") {
        $dirYear = date("Y");
        $dirMonth = date("m");
        $prefixFile = date("d-h-i");
        $slug = Tools::makeSlug($_POST["titre"]);
        $fileName = $prefixFile . "-" . $slug;
        $pathDir = "./files/" . $dirYear . "/" . $dirMonth;
        $pathFile = $pathDir . "/" . $fileName . ".txt";
        //création des réperoires s'ils n'existent pas : année et mois
        if (!file_exists($pathDir)) {
            mkdir($pathDir, 0777, true);
        }
        //création du fichier texte
        if (!$file = fopen($pathFile, "w+")) {
            echo "impossible d'ouvrir le fichier : " . $pathFile . "<br />";
        } else {
            //écriture dans le fichier
            $title = "[title]" . $_POST["titre"] . "[/title]\n";
            if (fwrite($file, $title) === false) {
                echo "impossible d'ouvrir le fichier : " . $pathFile . "<br />";
            }
            if (fwrite($file, $_POST["message"]) === false) {
                echo "impossible d'ouvrir le fichier : " . $pathFile . "<br />";
            }
            fclose($file);
            header(__DIR__.'\formulaire.php');
        }
    }
}
```
## Téléverser ds fichiers
Depuis un formulaire ayant : 
un attribut ```enctype="multipart/form-data"``` et  ```method="post"```
un champ de téléversement avec le nom ```fichier```
un champ hidden 
```html
<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
```
un bouton nommé ```uploadFile``` avec la valeur ```Charger```

```php
<?php
$messageUploaded = "";
$upload = false;
$uploadOk = false;
if (isset($_POST["uploadFile"]) && $_POST["uploadFile"] === "Charger") {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir . basename($_FILES['fichier']['name']);
    //création des réperoires s'ils n'existent pas : année et mois
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile)) {
        $messageUploaded = "Votre fichier est bien téléchargé";
        $uploadOk = true;
    } else {
        $messageUploaded = "Nope, pas du tout, fichier erroné ou erreur";
    }
}
?>
```
