<!DOCTYPE html>
<html>
<head>
    <title>MotoSession Acceuil</title>
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./Html/style/styleAcceuil.css" type="text/css"/>
</head>
<body style="background-image: url('./Html/img/background_acceuil.jpg');" >
    <header class="container">
        <div class="row">
            <img class="col-md-offset-4 col-md-1" src="./Html/img/logo.png"/>
            <h1 class="col-md-1">MotoSession</h1>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <?php
                    if(!isset($_SESSION['id'])&&!isset($_SESSION['siret'])){
                        echo'
                            <div id="connection" class="bulle">
                                <h2>Je me connecte</h2>
                                <a href="index.php?module=Connexion&action=formConnexion" class="enterResponses">Je me connecte</a>
                            </div>
                        

                    </div>

                    <div class=" col-md-offset-1 col-md-4">



                        <div id="creation compte" class="bulle">
                            <h2>je crée mon compte</h2>
                            <div class="enterResponsesDiv">
                                <a href="index.php?module=CreationCompte&action=inscriptionMotard" class="enterResponses">Je suis motard</a>
                            </div>
                            <div class="enterResponsesDiv">
                                <a href="index.php?module=CreationCompte&action=inscriptionGerant" class="enterResponses">Je suis gerant</a>
                            </div>
                        </div>';
                    }
                    else {
                        if(isset($_SESSION['id'])){ 
                            echo '<a href="index.php?module=Motard&action=acceuil">Acceuil</a>
                            <a href="index.php?module=Motard&action=profil">Voir mon profil</a>
                            <a href="index.php?module=Motard&action=session">Trouver Session</a>
                            <a href="index.php?module=Motard&action=effectue">Session Effectués</a>
                            <a href="index.php?module=Connexion&action=deconnexion" >Deconnexion</a>';
                        }
                        if(isset($_SESSION['siret'])){ 
                            echo '<a href="index.php?module=Gerant&action=acceuil">Acceuil</a>
                            <a href="index.php?module=Gerant&action=profil">Voir mon profil</a>
                            <a href="index.php?module=Gerant&action=mescircuits">Mes Circuits</a>
                            <a href="index.php?module=Gerant&action=messessions">Mes Sessions</a>
                            <a href="index.php?module=Connexion&action=deconnexion" >Deconnexion</a>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <section>
        <article> 
            <?= $menu ?>
        </article>
        <article>
            <?= $module ?>
        </article>
    </section>

</body>
</html> 


