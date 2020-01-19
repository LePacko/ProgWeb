<!DOCTYPE html>
<html>
<head>
	<title>MotoSession Acceuil</title>
    <link rel="stylesheet" href="./Html/style/styleAvantConnexion.css" type="text/css"/>
	<link link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	
	<meta charset="utf-8">
</head>

<body style="background-image: url('./Html/img/background_acceuil.jpg');" >
    <div id="tetePage">
        <div id="logodiv"><img src="./Html/img/logo.png" id="logo" /></div>
        <div id="titre">MotoSession</div>
    </div>
    <div id="corpPage">
            <div id="Connexion" class="bulle">
                <div id="TitreConnexion"><h2>Je me connecte</h2></div>
                <div id="LienConnexion"><a href="index.php?module=Connexion&action=formConnexion">Je me connecte</a></div>
            </div>

            <div id="CreationCompte">
                <div id="TitreCreerMoncompte" class="bulle">
                    <h2>Je crée mon compte</h2>
                </div>
                <div id="LienCreationCompte">
                    <div id="InscriptionMotard" class="enterResponsesDiv">
                        <a href="index.php?module=CreationCompte&action=inscriptionMotard" class="enterResponses">Je suis motard</a>
                    </div>
                    <div id="InscriptionGerant" class="enterResponsesDiv">
                        <a href="index.php?module=CreationCompte&action=inscriptionGerant" class="enterResponses">Je suis gerant</a>
                    </div>
                </div>
            </div>
                    
    </div>
    <section>
        <article> 
            <?= $compMenu ?>
        </article>
        <article>
            <?= $module ?>
        </article>
    </section>

    <!-- Animation -->

	
    <script type="text/javascript" src="./Html/AnimationJS/TitreAnimation.js"></script>

</body>
</html> 


