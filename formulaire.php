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
        <section class="row">
            <article class="col-md-6">
                <header>
                    <h2>Traitement des formulaires</h2>
                </header>
                <p>
                    Les formulaires servent a récupérer des informations pour traitement, par exemple, un serveur
                    php qui pourra les enregistrer en fichier, en bdd, ou les envoyer par mail.
                </p>
                <p>
                    Un formulaire se déclare à l'aide de la balise <code>form</code>. Il possède des
                    attributs,
                    dont les plus courants et importants sont : <code>method</code> & <code>action</code>
                </p>
                <h3>method</h3>
                <p>
                    C'est la méthode d'envoi des informations du formulaire, il en existe deux :
                </p>
                <ul>
                    <li>GET : les données sont envoyées associées à des
                        noms de variables dans l'url de la page de traitement</li>
                    <li>POST : Les données sont transmises en variables dans
                        l'entête HTTP.
                    </li>
                </ul>
                <p>
                    Si la méthode n'est pas indiquée dans le formulaire,
                    c'est GET qui sera utilisé par défaut
                </p>
                <h3>Action</h3>
                <p>
                    Indique l'url de la page de traitement des données envoyées par le formulaire.
                    Si action n'est pas précisé, le formulaire considère que c'est la page où il
                    se trouve qui sera la page de traitement.
                </p>
                <form method="get" action="./formulaire.php">
                    <fieldset>
                        <legend>
                            Civilité
                        </legend>
                        <p>
                            <label class="form-label" for="nom">Nom</label> : <input class="form-control" type="text" name="nom" id="nom" placeholder="Votre nom ici" aria-describedby="info-nom" required />
                        </p>
                        <div id="info-nom" class="alert alert-info">
                            Ce champ doit contenir votre nom d'usage, il est obligatoire.
                        </div>
                        <div id="alert-nom" class="alert alert-warning">
                            Vous devez remplir ce champ pour soumettre le formulaire.
                        </div>
                        <p>
                            <label class="form-label" for="email">Email</label> : <input class="form-control" type="text" name="email" id="email" placeholder="Votre email ici" aria-describedby="info-email" required />
                        </p>
                        <div id="info-email" class="alert alert-info">
                            Ce champ doit contenir votre email de contact, il est obligatoire.
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Description de votre demande</legend>
                        <p>
                            <label class="form-label" for="type-demande">Type de la demande</label>
                            <select class="form-select" name="type-demande" id="type-demande" aria-describedby="info-type-demande" required>
                                <option value="" selected>Choisir le type de la demande</option>
                                <optgroup label="Options unitaires">
                                    <option value="1">Opt 1</option>
                                    <option value="2">Opt 2</option>
                                    <option value="3">Opt 3</option>
                                    <option value="4">Opt 4</option>
                                    <option value="5">Opt 5</option>
                                </optgroup>
                                <optgroup label="Regroupement d'options">
                                    <option value="6">Tout sauf l'option 1</option>
                                    <option value="7">Tout sauf l'option 2</option>
                                    <option value="8">Tout sauf l'option 3</option>
                                </optgroup>
                            </select>
                        </p>
                        <div class="alert alert-info" id="info-type-demande">
                            Vous devez sélectionner le type de la demande, ce champ est obligatoire.
                        </div>
                        <p>
                            Vous représentez :
                        </p>
                        <p class="form-check">
                            <input class="form-check-input" type="radio" name="personne" id="physique" value="physique" checked aria-describedby="info-personne" /> <label class="form-check-label" class="form-label" for="physique">Personne Physique</label><br />
                            <input class="form-check-input" type="radio" name="personne" id="morale" value="morale" aria-describedby="info-personne" /> <label class="form-check-label" class="form-label" for="morale">Personne Morale</label>
                        </p>
                        <div class="alert alert-info" id="info-personne">
                            Votre demande est faîte pour un particulier (personne physique) ou une institution, asso, entreprise, etc(Personne Morale).
                        </div>
                        <p class="form-check">
                            <input class="form-check-input" type="checkbox" name="diff-email" id="diff-email" aria-describedby="info-diff" /> <label class="form-check-label" class="form-label" for="diff-email">Campagne d'emailing</label><br />
                            <input class="form-check-input" type="checkbox" name="diff-tel" id="diff-tel" aria-describedby="info-diff" /> <label class="form-check-label" class="form-label" for="diff-tel">Télé-opérateurs</label><br />
                            <input class="form-check-input" type="checkbox" name="diff-radio" id="diff-radio" aria-describedby="info-diff" /> <label class="form-check-label" class="form-label" for="diff-radio">Publicités radiophoniques</label><br />
                            <input class="form-check-input" type="checkbox" name="diff-tv" id="diff-tv" aria-describedby="info-diff" /> <label class="form-check-label" class="form-label" for="diff-tv">Publicités télévisuelles</label><br />
                        </p>
                        <label class="form-label" for="detail">Détail de vorte demande</label>
                        <p>
                            <textarea class="form-control" name="detail" id="detail" aria-describedby="info-detail" required></textarea>
                        </p>
                        <div class="alert alert-info" id="info-detail">
                            Veuillez préciser votre demande, ce champ est obligatoire
                        </div>
                    </fieldset>
                    <p>
                        <button class="btn btn-outline-success btn-sm" type="submit" name="formeSent" value="Envoyer">Envoyer</button>
                        <button class="btn btn-outline-warning btn-sm" type="reset">Vider le formulaire</button>
                    </p>
                </form>
            </article>
            <article class="col-md-6">
                <?php
                

                    ?>
                    <div class="h4">Résultats du formulaire</div>
                    <p>
                        <?= $nom ?>
                    </p>
                    <p>
                        <?= $email ?>
                    </p>
                    <p>
                        <?= $typeDemande ?>
                    </p>
                    <p>
                        <?= $personne ?>
                    </p>
                    <p>
                        Emailling : <?= $difEmail ?><br />
                        Téléphone : <?= $difTel ?><br />
                        Radio : <?= $difRadio ?><br />
                        TV : <?= $difTv ?><br />
                    </p>
                    <p>
                        <?= $detail ?>
                    </p>
                    <?php
                
                ?>
                <h2>Les fichiers</h2>
                <h3>Ouverture et fermeture d'un fichier</h3>
                <p>
                    fopen() et fclose()
                </p>
                <?php
                
                ?>
                <h3>Lire un fichier</h3>
                <p>
                    fread()
                </p>
                <?php
                
                ?>
                <h4>Lire un fichier en parcellaire fgets()</h4>
                <?php
                
                ?>
            </article>
            <article class="col-md-6">
                <h3>Créer des fichiers</h3>
                <form method="post" id="createFile">
                    <div class="mb-3">
                        <label class="form-label" for="titre">Titre :</label>
                        <input class="form-control" type="text" name="titre" value="" required placeholder="titre fichier" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="message">Texte :</label>
                        <textarea class="form-control" name="message" placeholder="Votre texte ici"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success" name="createFile" value="Envoyer">
                            Envoyer
                        </button>
                        <button type="reset" class="btn btn-warning" value="Annuler">
                            Annuler
                        </button>
                    </div>
                </form>
            </article>
            <article class="col-md-6">
                <h3>Téléverser des fichiers</h3>
                <?php  ?>
                    <div class=" alert-dismissible fade show" role="alert">
                        <?php echo $messageUploaded ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php  ?>
                <form enctype="multipart/form-data" method="post" id="uploadFile">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <div class="mb-3">
                        <label class="form-label" for="fichier">Fichier :</label>
                        <input class="form-control" type="file" name="fichier" required />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success" name="uploadFile" value="Charger">
                            Envoyer le fichier
                        </button>
                        <button type="reset" class="btn btn-warning" value="Annuler">
                            Annuler
                        </button>
                    </div>
                </form>
            </article>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>

</html>