<?php
require './src/Utils/Tools.php';
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
                    <h2>PDO</h2>
                </header>
                <h3>Principes</h3>
                <p>
                    PDO ou "Php Data Object" est un moyen de se connecter à une base de données et un moyen
                    de manipuler cette bdd. Son avantage tient dans le fait qu'on utilise les mêmes méthodes pour
                    manipuler des bases de données différentes (MySql, PostGre, Oracle, etc.).
                </p>
                <h2>Connexion avec PDO</h2>
                <p>
                    Il faut pour se connecter :
                </p>
                <ul>
                    <li>L'hôte</li>
                    <li>le nom de la bdd</li>
                    <li>le charset utilisé dans la bdd</li>
                    <li>identifiant utilisateur bdd</li>
                    <li>mot de passe utilisateur bdd</li>
                </ul>
                <p>
                    new PDO("mysql:host=&lsaquo;nom de l'hôte&rsaquo;;dbname=&lsaquo;nom bdd&rsaquo;;
                    charset=&lsaquo;jeu de caractère bdd&rsaquo;", "&lsaquo;nom de l'utilisateur&rsaquo;",
                    "&lsaquo;mdp utilisateur&rsaquo;");
                </p>
                <code>
                    //exemple<br />
                    $bdd = new PDO("mysql:host=localhost;dbname=2025-07-07-php-inter;charset=UTF8", "root", "");
                </code>
                <h3>Tester la connexion</h3>
                <?php
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=2025-07-07-php-inter;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
                    echo '<p>la connexion fonctionne</p>';
                    /*var_dump($bdd);*/
                    Tools::prePrint($bdd);
                }catch(Exception $e){
                    echo '<p>Erreur de connexion : '. $e->getMessage().'</p>';
                }
                ?>
            </article>
            <article>
                <header>
                    <h2>Requêter avec PDO</h2>
                </header>
                <p>
                    On peut utiliser la méthode query
                </p>
                <code>
                    $response = $bdd->query("SELECT * FROM `jeux_video`");
                </code>
                <?php
                $response = $bdd->query("SELECT * FROM `jeux_video`");
                Tools::prePrint($response);
                ?>
                <p>
                    $response contient désormais le jeu d'enregistrements récupéré via la requête.
                    On ne peut pas exploiter $response directement, il va falloir utliser les méthodes
                    de PDO désormais utilisables avec $response.
                </p>
                <code>
                    $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);<br />
                    print_r($unEnregistrement);<br />
                    $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);<br />
                    print_r($unEnregistrement);<br />
                </code>
                <?php
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
                Tools::prePrint($unEnregistrement);
                Tools::prePrint($unEnregistrement['nom']);
                $unEnregistrement = $response->fetch(PDO::FETCH_NUM);
                Tools::prePrint($unEnregistrement);
                Tools::prePrint($unEnregistrement[1]);
                $unEnregistrement = $response->fetch(PDO::FETCH_BOTH);
                Tools::prePrint($unEnregistrement);
                Tools::prePrint($unEnregistrement[1]);
                Tools::prePrint($unEnregistrement['nom']);
                ?>
                <p>
                    fetch() renvoie l'enregistrement actuel où se trouve le curseur dans le jeu d'enregistrement.
                    Une fois qu'il a renvoyé les données, le curseur passe à l'enregistrement suivant.
                </p>
                <p>
                    Il faut, une fois qu'on a finit d'utiliser les données, "fermer" le curseur.
                </p>
                <code>
                    $response->closeCursor();
                </code>
                <?php
                $response->closeCursor();
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
                Tools::prePrint($unEnregistrement);
                ?>
            </article>
            <article>
                <header>
                    <h2>Exploiter les résultats</h2>
                </header>
                <p>
                    Maintenant, on relance la requête et on va afficher les résultats
                    dans un tableau généré par une boucle
                </p>
                <?php
                /*  lancer la requête suivante SELECT * FROM `Jeux_video` ORDER BY `ID` DESC */
                $response = $bdd->query("SELECT * FROM `jeux_video` ORDER BY `ID` DESC");
                Tools::prePrint($response->rowCount());
                ?>
                <div class="table-responsive" style="height: 300px;">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Jeu</th>
                                <th>Possesseur</th>
                                <th>Prix</th>
                                <th>Console</th>
                                <th>nb joueurs max</th>
                                <th>Commentaire(s)</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($donnees = $response->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $donnees['nom'] ?></td>
                                    <td><?= $donnees['possesseur'] ?></td>
                                    <td><?= $donnees['prix'] ?></td>
                                    <td><?= $donnees['console'] ?></td>
                                    <td><?= $donnees['nbre_joueurs_max'] ?></td>
                                    <td><?= $donnees['commentaires'] ?></td>
                                    <td style="width: 250px;">
                                        <a href="./actionJV.php?action=mod&idJV=<?= $donnees['ID'] ?>"><button class="btn btn-primary">Modifier</button></a> 
                                        <a href="./actionJV.php?action=sup&idJV=<?= $donnees['ID'] ?>"><button class="btn btn-danger">Supprimer</button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                $response->closeCursor();
                ?>
            </article>
            <article class="col-lg-6">
                <header>
                    <h2>Les requêtes préparées</h2>
                </header>
                <p>
                    Si on veut pouvoir choisir des paramètres pour la recherche (comme des filtres), il faut utiliser
                    les méthodes PDO de préparation de requête.
                </p>
                <?php
                /* Lier par clef dans la requête */

                $sql = 'SELECT * FROM `jeux_video` WHERE `ID` = :id ';
                $response = $bdd->prepare($sql);
                $idJeux = 1;
                $response->bindParam(':id', $idJeux, PDO::PARAM_INT);
                $response->execute();
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
                Tools::prePrint($unEnregistrement);

                /* Lier par ordre dans la requête */

                $sql = 'SELECT * FROM `jeux_video` WHERE `ID` = ? ';
                $response = $bdd->prepare($sql);
                $idJeux = 1;
                $response->bindParam(1, $idJeux, PDO::PARAM_INT);
                $response->execute();
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
                Tools::prePrint($unEnregistrement);

                /* lier par clef dans la requête avec plusieurs paramètres dans execute */
                $sql = 'SELECT * FROM `jeux_video` WHERE `ID` = :id and `possesseur` LIKE :possesseur ';
                $response = $bdd->prepare($sql);
                $response->execute(
                    ['id' => 1, 'possesseur' => 'Florent']
                );
                Tools::prePrint($response);
                $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
                Tools::prePrint($unEnregistrement);
                ?>
                <form>
                    <fieldset class="form-group my-2">
                        <label for="possesseur" class="form-label">Possesseur</label>
                        <input type="text" class="form-control" name="possesseur" id="possesseur" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="prixmax" class="form-label">Prix Maximum</label>
                        <input type="text" class="form-control" name="prixmax" id="prixmax" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="console" class="form-label">Console</label>
                        <input type="text" class="form-control" name="console" id="console" />
                    </fieldset>
                    <p class="my-2">
                        <button class="btn btn-outline-primary" name="soumettre" type="submit" value="soumettre">Rechercher</button>
                    </p>
                </form>
                <?php
                $tabFields = [];
                $tabConditions = [];
                $conditions = '';
                if( isset($_GET['soumettre']) &&  $_GET['soumettre'] === 'soumettre'){
                    if(isset($_GET['possesseur']) && $_GET['possesseur'] !== ''){
                        $tabFields['possesseur'] = $_GET['possesseur'];
                        $tabConditions[] = ' `possesseur` = :possesseur ';
                    }
                    if(isset($_GET['prixmax']) && $_GET['prixmax'] !== ''){
                        $tabFields['prixmax'] = $_GET['prixmax'];
                        $tabConditions[] = ' `prix` <= :prixmax ';
                    }
                    if(isset($_GET['console']) && $_GET['console'] !== ''){
                        $tabFields['console'] = $_GET['console'];
                        $tabConditions[] = ' `console` = :console ';
                    }
                    Tools::prePrint($tabFields);
                    Tools::prePrint($tabConditions);

                    if(count($tabConditions) > 0){
                        for($i = 0; $i < count($tabConditions); $i++){
                            $conditions .= ( ($i === 0)? ' WHERE ': ' AND ' ) ;
                            $conditions .= $tabConditions[$i];
                        }
                    }

                    Tools::prePrint($conditions);
                    
                }

                $sql = 'SELECT * FROM `jeux_video` ' . $conditions . ' ORDER BY `nom`';

                $req = $bdd->prepare($sql);
                $req->execute($tabFields);

                ?>
                <div class="table-responsive" style="height: 300px;">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Jeu</th>
                                <th>Possesseur</th>
                                <th>Prix</th>
                                <th>Console</th>
                                <th>nb joueurs max</th>
                                <th>Commentaire(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $donnees['nom'] ?></td>
                                    <td><?= $donnees['possesseur'] ?></td>
                                    <td><?= $donnees['prix'] ?></td>
                                    <td><?= $donnees['console'] ?></td>
                                    <td><?= $donnees['nbre_joueurs_max'] ?></td>
                                    <td><?= $donnees['commentaires'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                $req->closeCursor();
                ?>
            </article>
            <article class="col-lg-6">
                <header>
                    <h2>Manipulation des enregistrements</h2>
                </header>
                <h3>Ajoût de données</h3>
                <form method="post">
                    <fieldset class="form-group my-2">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="possesseur" class="form-label">Possesseur</label>
                        <input type="text" class="form-control" name="possesseur" id="possesseur" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="console" class="form-label">Console</label>
                        <input type="text" class="form-control" name="console" id="console" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="prix" class="form-label">Prix</label>
                        <input type="text" class="form-control" name="prix" id="prix" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="nbre_joueurs_max" class="form-label">Nombre de joueurs max</label>
                        <input type="text" class="form-control" name="nbre_joueurs_max" id="nbre_joueurs_max" />
                    </fieldset>
                    <fieldset class="form-group my-2">
                        <label for="commentaires" class="form-label">Commentaire</label>
                        <input type="text" class="form-control" name="commentaires" id="commentaires" />
                    </fieldset>
                    <p class="my-2">
                        <button class="btn btn-outline-primary" name="ajoutJeu" type="submit" value="ajoutJeu">Ajouter le jeu</button>
                    </p>
                </form>
                <?php
                tools::prePrint($_POST);
                if( isset($_POST['ajoutJeu']) && $_POST['ajoutJeu'] === 'ajoutJeu' ){
                    $params = $_POST;
                    unset($params['ajoutJeu']);
                    Tools::prePrint($params);

                    $keys = '(';
                    $values = '(';
                    $i = 0;
                    foreach($params as $key => $value){
                        if($i !== 0){
                            $keys .= ', ';
                            $values .= ', ';
                        }
                        $i++;
                        $keys .= $key;
                        $values .= ':'.$key;
                    }

                    $keys .= ')';
                    $values .= ')';

                    $sql = 'INSERT INTO `jeux_video` '.$keys . ' VALUES '.$values .';';
                    Tools::prePrint($sql);
                    /*
                    INSERT INTO `jeux_video` 
                        (nom, possesseur, console, prix, nbre_joueurs_max, commentaires) 
                    VALUES 
                        (:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires);
                    */

                    $req = $bdd->prepare($sql);
                    $req->execute($params) or die(Tools::prePrint($bdd->errorInfo())) ;
                    ?>
                    <script>
                        document.location.href= './pdo.php';
                    </script>
                    <?php

                }
                ?>
            </article>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>
</html>