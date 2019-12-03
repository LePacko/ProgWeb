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

                <div id="connection" class="bulle">
                    <h2>Je me connecte</h2>
                    <form action="" method="post">
                        <div>
                            <input type="email" id="email" name="email_co" class="enterResponses" placeholder="email">
                        </div>
                        <div>
                            <input type="password" id="pswd" name="pswd_co"class="enterResponses" placeholder="mot de passe">
                        </div>
                        <div>
                            <button type="submit" class="enterResponses">Connexion</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class=" col-md-offset-1 col-md-4">
            <?php
            if(!isset($_SESSION['id'])&&!isset($_SESSION['siret'])){
                echo'

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
                echo '<a href="index.php?module=Connexion&action=deconnexion" >Deconnexion</a>
                <a href="index.php?module=Connexion&action=profil">Voir mon profil</a>';
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


