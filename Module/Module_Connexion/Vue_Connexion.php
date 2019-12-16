<?php 
	

	class Vue_Connexion {

		function __construct() {
			
		}

		function formulaireConnexion () {
			echo '<div  id="connection" class="bulle col-md-offset-4 col-md-4">
			<form action="index.php?module=Connexion&action=connexion" method="post">
				<div>
					<input type="text" name="id" class="enterResponses" placeholder="email">
				</div>
				<div>
					<input  type="password" name="mdp" class="enterResponses" placeholder="mot de passe">
				</div>
				<div>
					<button type="submit" class="enterResponses">Connexion</button>
				</div>
			</form>
		</div>';
		}

		function afficherProfil($tab)  {
			var_dump($tab);			
		}
		
	}
		
?>