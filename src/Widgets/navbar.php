<?php
use Utils\Tools;
?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <i class="bi bi-house-fill"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('index.php') ?>" href="./index.php" title="Page d'accueil du site">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('formulaire.php') ?>" href="./formulaire.php" title="Utilisation dee Formulaire">Formulaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('exceptions.php') ?>" href="./exceptions.php" title="Les exceptions">Exceptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('pdo.php') ?>" href="./pdo.php" title="Utilisation de PDO">PDO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('classesetendues.php') ?>" href="./classesetendues.php" title="Les classes étendues">Classes étendues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= Tools::classActive('classesetpdo.php') ?>" href="./classesetpdo.php" title="Les classes et PDO">Classe et PDO</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link " href="./mediatheque.php" title="Les classes étendues">TD - Exo Mediathèque</a>
                </li>
                -->
            </ul>
        </div>
    </div>
</nav>