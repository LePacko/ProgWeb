<!DOCTYPE html>
<html>
<head>
	<title>MotoSession Acceuil</title>
	<link link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<link rel="stylesheet" href="./Html/style/styleAcceuil.css" type="text/css"/>
	<meta charset="utf-8">
</head>

<body style="background-image: url('./Html/img/background_acceuil.jpg');" >
    <header class="container">
        <div class="row">
            <img class="logo col-md-offset-4 col-md-1" src="./Html/img/logo.png"/>
            <h1 class="col-md-1 titre">MotoSession</h1>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col- modife deco eet module gerantmd-offset-2 col-md-4">
                <?php
                    if(!isset($_SESSION['session_motard'])&&!isset($_SESSION['session_gerant'])){ // si personne n'est connecté
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
                        if(isset($_SESSION['session_motard'])){       // si il s'agit d'un motard qui est connecté 
                            include ("./Html/NavMotard.html");
                        }
                        if(isset($_SESSION['session_gerant'])){      // si il s'agit d'un gérant de circuit
                            include ("./Html/NavGerant.html");
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

    <!-- Animation -->

	<script type="text/javascript" src="./Html/AnimationJs/FonduAnimation.js"></script>
    <script type="text/javascript" src="./Html/AnimationJS/TitreAnimation.js"></script>

</body>
</html> 


