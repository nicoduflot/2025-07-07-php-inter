<?php

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
                    <h2>Gestion des jeux</h2>
                </header>
                <?php if($formMod){ ?>
                    <h3>Modifier le jeu </h3>
                    <form method="post" action="./actionJV.php">
                        <input type="hidden" name="ID" value="<?php echo $id ?>" />
                        <fieldset class="form-group my-2">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom ?>" />
                        </fieldset>
                        <fieldset class="form-group my-2">
                            <label for="possesseur" class="form-label">Possesseur</label>
                            <input type="text" class="form-control" name="possesseur" id="possesseur" value="<?php echo $possesseur ?>" />
                        </fieldset>
                        <fieldset class="form-group my-2">
                            <label for="console" class="form-label">Console</label>
                            <input type="text" class="form-control" name="console" id="console" value="<?php echo $console ?>" />
                        </fieldset>
                        <fieldset class="form-group my-2">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="text" class="form-control" name="prix" id="prix" value="<?php echo $prix ?>" />
                        </fieldset>
                        <fieldset class="form-group my-2">
                            <label for="nbJmax" class="form-label">Nombre de joueurs max</label>
                            <input type="text" class="form-control" name="nbre_joueurs_max" id="nbre_joueurs_max" value="<?php echo $nbre_joueurs_max ?>" />
                        </fieldset>
                        <fieldset class="form-group my-2">
                            <label for="commentaires" class="form-label">Commentaire</label>
                            <input type="text" class="form-control" name="commentaires" id="commentaires" value="<?php echo $commentaires ?>" />
                        </fieldset>
                        <p class="my-2">
                            <button class="btn btn-outline-primary" name="modBdd" type="submit" value="modJeu">Modifier le jeu</button>
                        </p>
                    </form>
                <?php
                }
                if($formSup){
                ?>    
                    <h3>Supprimer le jeu </h3>
                    <form method="post" action="./actionJV.php">
                        <input type="hidden" name="ID" value="<?php echo $id ?>" />
                        Êtes-vous sûr de vouloir supprimer le jeu suivant : <b><?php echo $nom ?></b> ?
                        <p class="my-2">
                            <button class="btn btn-outline-danger" name="modBdd" type="submit" value="supJeu">Supprimer le jeu</button>
                            <a href="./pdo.php"><button class="btn btn-outline-secondary" type="button">Annuler</button></a>
                        </p>
                    </form>
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