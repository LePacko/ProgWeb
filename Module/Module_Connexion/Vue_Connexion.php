<?php 
	

	class Vue_Connexion {

		function __construct() {
			
		}

		function formulaireConnexion () {
			echo '<h3>CONNEXION</h3>
				<form action="index.php?module=Connexion&action=connexion" method="post">
					<p>Identifiant : <input type="text" name="id" /></p>
					<p>Mot de passe: <input type="password" name="mdp" /></p>
					<p><input type="submit" value="OK"></p>
				</form>';
		}

		function afficherProfil($tab)  {
			var_dump($tab);
		}
		
	}
		
?>