<?php
session_start();
include './src/includes/autoload.php';
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
                    <h2>Classes et PDO</h2>
                </header>
                <h3>Principes</h3>
                <p>
                    Intégrer dans les classes Compte (et les enfants) des méthodes pour enregistrer ou modifier voir supprimer des comptes.
                </p>
                <ul>
                    <li><a href="./creaCompte.php?typecompte=Compte">Un compte</a></li>
                    <li><a href="./creaCompte.php?typecompte=CompteCheque">Un compte chèque</a></li>
                    <li><a href="./creaCompte.php?typecompte=CompteInteret">Un compte intérêt</a></li>
                </ul>
            </article>
            <article>
                <header>
                    <h2>Les Comptes enregistrés</h2>
                </header>
                <?php
                $sqlCompte = '
                    SELECT 
                        * 
                    FROM 
                        `compte` 
                    WHERE 
                        `typecompte` = \'Compte\';
                ';
                $request = Tools::modBdd($sqlCompte);
                ?>
                <div class="table-responsive">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Numéro de compte</th>
                                <th>Numéro d'agence</th>
                                <th>RIB</th>
                                <th>IBAN</th>
                                <th>Solde</th>
                                <th>Découvert autorisé</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($compte = $request->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $compte['nom'] ?></td>
                                    <td><?= $compte['prenom'] ?></td>
                                    <td><?= $compte['numcompte'] ?></td>
                                    <td><?= $compte['numagence'] ?></td>
                                    <td><?= $compte['rib'] ?></td>
                                    <td><?= $compte['iban'] ?></td>
                                    <td><?= $compte['solde'] ?></td>
                                    <td><?= $compte['decouvert'] ?></td>
                                    <td>
                                        <a href="./gestionCompte.php?action=show&id=<?= $compte['id'] ?>" title="Voir le compte"><button class="btn btn-primary btn-small"><i class="bi bi-card-text"></i></button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </article>
            <article>
                <header>
                    <h2>Les comptes chèques enregistrés</h2>
                </header>
                <?php
                $sqlCompteCheque = '
                    SELECT 
                        `compte`.*, `carte`.`cardnumber`, `carte`.`codepin`
                    FROM 
                        `compte` LEFT JOIN 
                        `carte` ON `compte`.`cardid` = `carte`.`id` 
                    WHERE 
                        `typecompte` = \'CompteCheque\' 
                    ORDER BY 
                        `compte`.`nom`; 
                    ';
                $request = Tools::modBdd($sqlCompteCheque);
                ?>
                <div class="table-responsive">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Numéro de compte</th>
                                <th>Numéro d'agence</th>
                                <th>RIB</th>
                                <th>IBAN</th>
                                <th>Solde</th>
                                <th>Découvert autorisé</th>
                                <th>Numéro de carte</th>
                                <th>Code Pin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($compte = $request->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?php echo $compte['nom'] ?></td>
                                    <td><?php echo $compte['prenom'] ?></td>
                                    <td><?php echo $compte['numcompte'] ?></td>
                                    <td><?php echo $compte['numagence'] ?></td>
                                    <td><?php echo $compte['rib'] ?></td>
                                    <td><?php echo $compte['iban'] ?></td>
                                    <td><?php echo $compte['solde'] ?></td>
                                    <td><?php echo $compte['decouvert'] ?></td>
                                    <td><?php echo $compte['cardnumber'] ?></td>
                                    <td><?php echo $compte['codepin'] ?></td>
                                    <td><a href="./gestionCompte.php?action=show&id=<?= $compte['id'] ?>" title="Voir le compte"><button class="btn btn-primary btn-small"><i class="bi bi-card-text"></i></button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </article>
            <article>
                <header>
                    <h2>Les comptes intérêts enregistrés</h2>
                </header>
                <?php
                 $sqlCompteInteret = '
                    SELECT * FROM `compte` 
                    WHERE `typecompte` = \'CompteInteret\'
                    ORDER BY `compte`.`nom`;';
                $request = Tools::modBdd($sqlCompteInteret);
                ?>
                <div class="table-responsive">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Numéro de compte</th>
                                <th>Numéro d'agence</th>
                                <th>RIB</th>
                                <th>IBAN</th>
                                <th>Solde</th>
                                <th>Taux d'intérêt</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($compte = $request->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?php echo $compte['nom'] ?></td>
                                    <td><?php echo $compte['prenom'] ?></td>
                                    <td><?php echo $compte['numcompte'] ?></td>
                                    <td><?php echo $compte['numagence'] ?></td>
                                    <td><?php echo $compte['rib'] ?></td>
                                    <td><?php echo $compte['iban'] ?></td>
                                    <td><?php echo $compte['solde'] ?></td>
                                    <td><?php echo $compte['taux'] ?></td>
                                    <td>
                                        <a href="./gestionCompte.php?action=show&id=<?= $compte['id'] ?>" title="Voir le compte"><button class="btn btn-primary btn-small"><i class="bi bi-card-text"></i></button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>
</html>