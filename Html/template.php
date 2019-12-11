<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php $title ?></title>
        <link href="style.css" rel="stylesheet" /> 
          <a href="index.php"><h1 style='text-align: center;'> Mon site de sessions </h1></a>
        
    </head>

    <nav>
        <?php
            if(!isset($_SESSION['id'])&&!isset($_SESSION['siret'])){
               echo'<a href="index.php?module=CreationCompte&action=inscriptionMotard">Je suis un motard</a>                <!--Creation compte-->
                <a href="index.php?module=CreationCompte&action=inscriptionGerant">Je suis un gérant de circuit</a>     <!--Creation compte-->  
                <a href="index.php?module=Connexion&action=formConnexion">Je me connecte</a>';

            }
            else {
                echo '<a href="index.php?module=Connexion&action=deconnexion" >Deconnexion</a>
                <a href="index.php?module=Connexion&action=profil">Voir mon profil</a>';
            }
                    ?>

    </nav>

    <body>
    <section>
        <article> 
            <?= $menu ?>
        </article>
        <article>
            <?= $module ?>
        </article>
    </section>
    </body>
    <footer> </footer>
</html>