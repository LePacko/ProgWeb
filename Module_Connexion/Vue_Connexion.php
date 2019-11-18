<?php 
	

	class Vue_Connexion {

		function __construct() {
			
		}

		function afficheFormulaireCreationCompte() {

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>Creation de compte</title>
			<link rel="stylesheet" type="text/css" href="FormulaireCreationCompteMotard.css">
		</head>
		<body>
		
			<form method="post" action="./index.php?action=ajoutMotardBD">
			
				<label>Nom</label>
				<input type="text" name="Nom"required><br>
				<label>Prenom</label>
				<input type="text" name="Prenom"required><br>
				<label>Mail</label>
				<input type="email" name="Mail"required><br>
				<label>Mot de passe</label>
				<input type="password" name="MotDePasse"required><br>
				<input type="submit" value="Crée mon compte">

			</form>

		</body>
		</html>
		<?php

		

		}

		
	}


?>