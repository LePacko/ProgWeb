<?php 
	

	class Vue_Connexion {

		function __construct() {
			
		}

		function afficheFormulaireCreationCompte() {

		?>
		<form method="post" action="modele.php">
		
		
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
		<?php

		

		}

		
	}


?>