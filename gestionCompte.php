<?php
session_start();
include './src/includes/autoload.php';

use Utils\Tools;
use App\Banque\Compte;
use App\Banque\CompteCheque;
use App\Banque\CompteInteret;
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
            <article class="col-lg-8 offset-lg-2">
                <header>
                    <h2>Gestion d'un compte Compte</h2>
                </header>
                <?php
                /* on arrive d'un formulaire de modification ou de suppression */
                if(isset($_POST['action']) && $_POST['action'] === 'edit'){
                    /* modification */
                    $compte = unserialize($_SESSION['compte']);
                    /*Tools::prePrint($compte);
                    Tools::prePrint($_POST);*/
                    $compte->setNom($_POST['nom']);
                    $compte->setPrenom($_POST['prenom']);
                    $compte->setNumcompte($_POST['numcompte']);
                    $compte->setNumagence($_POST['numagence']);
                    $compte->setRib($_POST['rib']);
                    $compte->setIban($_POST['iban']);
                    $compte->setSolde($_POST['solde']);
                    $compte->setDevise($_POST['devise']);
                    if($compte->typecompte()==='CompteCheque'){
                        $compte->getCarte()->setNumcarte($_POST['numcarte']);
                        $compte->getCarte()->setCodepin($_POST['codepin']);
                    }
                    if($compte->typeCompte()==='CompteInteret'){
                        $compte->setTaux($_POST['taux']);
                    }
                    $compte->majCompte();
                    ?>
                    <script>
                        document.location.href = './classesetpdo.php';
                    </script>
                    <?php
                    /*Tools::prePrint($compte);*/
                }
                if(isset($_POST['action']) && $_POST['action'] === 'supp'){
                    /* suppression */
                    $compte = unserialize($_SESSION['compte']);
                    /*Tools::prePrint($compte);
                    Tools::prePrint($_POST);*/
                    $compte->suppCompte();
                    ?>
                    <script>
                        document.location.href = './classesetpdo.php';
                    </script>
                    <?php
                }

                /* on viens du bouton "afficher compte" */
                /*
                GET avec action = show id = id du compte
                */
                if (isset($_GET['action']) && isset($_GET['id']) && $_GET['id'] !== '') {
                    switch ($_GET['action']) {
                        case 'show':
                            $idcompte = $_GET['id'];
                            $sql = '
                                    SELECT 
                                        * 
                                    FROM 
                                        `compte` LEFT JOIN 
                                        `carte` ON `compte`.`cardid` = `carte`.`id` 
                                    WHERE 
                                        `compte`.`id` = :id; 
                                    ';
                            $params = ['id' => $idcompte];
                            $request = Tools::modBdd($sql, $params);
                            $data = $request->fetch(PDO::FETCH_ASSOC);
                            switch ($data['typecompte']) {
                                case 'Compte':
                                    $compte = new Compte(
                                        $data['nom'],
                                        $data['prenom'],
                                        $data['numcompte'],
                                        $data['numagence'],
                                        $data['rib'],
                                        $data['iban'],
                                        $data['solde'],
                                        $data['decouvert'],
                                        $data['devise']                                  
                                    );
                                    break;
                                case 'CompteCheque':
                                    $compte = new CompteCheque(
                                        $data['nom'],
                                        $data['prenom'],
                                        $data['numcompte'],
                                        $data['numagence'],
                                        $data['rib'],
                                        $data['iban'],
                                        $data['cardnumber'],
                                        $data['codepin'],
                                        $data['solde'],
                                        $data['decouvert'],
                                        $data['devise']
                                    );
                                    break;
                                case 'CompteInteret':
                                    $compte = new CompteInteret(
                                        $data['nom'],
                                        $data['prenom'],
                                        $data['numcompte'],
                                        $data['numagence'],
                                        $data['rib'],
                                        $data['iban'],
                                        $data['solde'],
                                        $data['taux'],
                                        $data['decouvert'],
                                        $data['devise']
                                    );
                                    break;
                            }
                            $compte->setId($idcompte);
                            $_SESSION['compte'] = serialize($compte);
                            
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th colspan="2">Numéro de compte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $compte->getNom() ?></td>
                                        <td><?= $compte->getPrenom() ?></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <th>Numéro d'agence</th>
                                        <th>RIB</th>
                                        <th>IBAN</th>
                                        <th>Solde</th>
                                    </tr>
                                    <tr>
                                        <td><?= $compte->getNumagence() ?></td>
                                        <td><?= $compte->getRib() ?></td>
                                        <td><?= $compte->getIban() ?></td>
                                        <td><?= $compte->getSolde() ?></td>
                                    </tr>
                                    <?php
                                    if($data['typecompte'] === 'CompteCheque'){
                                    ?>
                                    <tr>
                                        <th colspan="2">Numéro de carte</th>
                                        <th colspan="2">Code Pin</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?= $compte->getCarte()->getNumCarte() ?></td>
                                        <td colspan="2"><?= $compte->getCarte()->getCodepin() ?></td>
                                    </tr>
                                    <?php
                                    }
                                    if($data['typecompte'] === 'CompteInteret'){
                                    ?>
                                    <tr>
                                        <th>Taux d'intérêt</th>
                                    </tr>
                                    <tr>
                                        <td><?= $compte->getTaux() ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php

                            break;
                        case 'edit':
                            $compte = unserialize($_SESSION['compte']);
                            /*tools::prePrint($compte);*/
                        ?>
                            <form method="post" action="./gestionCompte.php">
                                <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>" />
                                <input type="hidden" name="action" id="action" value="edit" />
                                <input type="hidden" name="devise" id="devise" value="<?= $compte->getDevise() ?>" />
                                <fieldset class="form-control my-2">
                                    <legend>
                                        Détenteur du compte
                                    </legend>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" name="nom" id="nom" value="<?= $compte->getNom() ?>" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" class="form-control" name="prenom" id="nom" value="<?= $compte->getprenom() ?>" />
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="form-control my-2">
                                    <legend>Agence</legend>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="numagence">Numéro d'agence</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="numagence" id="numagence" value="<?= $compte->getNumagence() ?>" />
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="form-control my-2">
                                    <legend>
                                        Détails du compte
                                    </legend>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="type">Type de compte</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control my-2" type="text" name="type" id="type" value="<?= $compte->typeCompte() ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="numcompte">Numéro de compte</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control my-2" type="text" name="numcompte" id="numcompte" value="<?= $compte->getNumcompte() ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="rib">RIB</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control my-2" type="text" name="rib" id="rib" value="<?= $compte->getRib() ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="iban">IBAN</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control my-2" type="iban" name="iban" id="type" value="<?= $compte->getIban() ?>" readonly />
                                        </div>
                                    </div>
                                    <?php
                                    if($compte->typeCompte()==='CompteCheque'){
                                    ?>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="decouvert">Découvert</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" name="decouvert" id="decouvert" value="<?= $compte->getDecouvert() ?>" />
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="numcarte">Numéro de carte</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" readonly class="form-control" name="numcarte" id="numcarte" value="<?= $compte->getCarte()->getNumCarte() ?>" />
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="codepin">Code secret</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" readonly class="form-control" name="codepin" id="codepin" value="<?= $compte->getCarte()->getCodepin() ?>" />
                                        </div>
                                    </div>
                                    <?php

                                    }
                                     if($compte->typeCompte()==='CompteInteret'){
                                    ?>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="taux">Taux d'intérêts</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-select" name="taux" id="taux">
                                                <option>Choisir le taux d'intéret</option>
                                                <option <?= ($compte->getTaux() === 0.015)? 'selected': '' ?> value="0.015">1.5%</option>
                                                <option <?= ($compte->getTaux() === 0.03)? 'selected': '' ?> value="0.03">3%</option>
                                                <option <?= ($compte->getTaux() === 0.05)? 'selected': '' ?> value="0.05">5%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php

                                     }


                                    ?>
                                    <div class="row my-2">
                                        <div class="col-lg-6">
                                            <label for="solde">Solde</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" name="solde" id="solde" value="<?= $compte->getSolde() ?>" />
                                        </div>
                                    </div>
                                </fieldset>
                                <p>
                                    <button class="btn btn-outline-success btn-small" type="submit">
                                        Valider les modifications
                                    </button>
                                    <button class="btn btn-outline-warning btn-small" type="reset">
                                        Valeurs par défaut
                                    </button>
                                    <a href="./gestionCompte.php?action=show&id="><button class="btn btn-outline-secondary btn-small" type="button">Annuler</button></a>
                                </p>
                            </form>
                        <?php
                            break;
                        case 'supp':
                        ?>
                            <form method="post" action="./gestionCompte.php">
                                <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>" />
                                <input type="hidden" name="action" id="action" value="supp" />
                                <p>
                                    <button class="btn btn-outline-success btn-small" type="submit">
                                        Valider la suppression
                                    </button>
                                    <a href="./gestionCompte.php?action=show&id=<?= $_GET['id'] ?>"><button class="btn btn-outline-secondary btn-small" type="button">Annuler</button></a>
                                </p>
                            </form>
                <?php
                            break;
                        default:
                    }
                }
                ?>
                <p>
                    <a href="./classesetpdo.php" title="Retour à la liste des compte"><button class="btn btn-secondary btn-small"><i class="bi bi-list"></i></button></a>
                    <a href="./gestionCompte.php?action=show&id=<?= $_GET['id'] ?>" title="Voir le compte"><button class="btn btn-success btn-small"><i class="bi bi-card-text"></i></button></a>
                    <a href="./gestionCompte.php?action=edit&id=<?= $_GET['id'] ?>" title="Éditer le compte"><button class="btn btn-secondary btn-small"><i class="bi bi-pencil-fill"></i></button></a>
                    <a href="./gestionCompte.php?action=supp&id=<?= $_GET['id'] ?>" title="Supprimer le compte"><button class="btn btn-danger btn-small"><i class="bi bi-trash-fill"></i></button></a>
                </p>
            </article>
            <?php

            ?>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>

</html>