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
                    <h2>Exceptions</h2>
                </header>
                <h3>Principes</h3>
                <p>
                    Exception est une classe Php qui existe par défaut.
                    Pour générer une exception dans un programme, il faut l'appeler à l'intéreur de la fonction a tester.
                </p>
                <code>
                    echo multiplier(20, 12);<br />
                    echo multiplier("test", 23);<br />
                    echo multiplier(113, 42);<br />
                </code>
                <?php
                function multiplier($x, $y){
                    if( !is_numeric($x) || !is_numeric($y) ){
                        throw new Exception('Les deux valeurs doivent être numériques');
                    }
                    return $x * $y;
                }

                try{
                    echo multiplier(20, 12).'<br />';
                    echo multiplier('test', 12).'<br />';
                    echo multiplier(5, 12).'<br />';
                }catch(Exception $e){
                    /*var_dump($e);*/
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show">
                        Une exception a été lancée<br />
                        Message : '.$e->getMessage().'<br />
                        Code : '.$e->getCode().'<br />
                        Fichier : '.$e->getFile().'<br />
                        Ligne : '.$e->getLine().'<br />
                        Trace : '.$e->getTraceAsString().'<br />
                        Précédent : '.$e->getPrevious().'<br />
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                    ';
                }
                ?>
                <p>
                    Si on n'utilise pas de try-catch sur des expression lançant des Exceptions,
                    le reste du programme ne continue, ce qui génère des pages incomplètes.
                </p>
                <p>
                    Contrairement au premier exemple, le reste des instructions hors try s'exécutent normalement,
                    donc le reste de la page s'affiche.
                </p>
                <h4>Surcharger Exception : classe étendue personnelle</h4>
                <p>
                    Comme Exception est une classe, il est donc possible de créer sa propre classe étendue d'Exception.
                    En surchargeant les méthodes, on peut filtrer ou ne demander que ses propres exceptions.
                    Par exemple, n'avoir que getMessage() au retour d'une exception.
                </p>
                <?php
                
                ?>
                <h4>Exception dans PDO</h4>
                <p>
                    Il existe des exceptions pour PDO, mais elles ne sont pas natives dans Php, il faut
                    les installer, il existe des dépendances sur packagist installable avec composer
                </p>
                <code>
                    composer require php-kit/ext-pdo
                </code>
                <p>
                    <?php
                    
                    ?>
                </p>
            </article>
        </section>
    </main>
    <?php
    include './src/Widgets/footer.php';
    ?>
</body>
</html>