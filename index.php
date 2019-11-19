<?php 
	require_once("./Module/Module_Connexion/Module_Connexion.php");
	require_once("./Module/Module_CreationCompte/Module_CreationCompte.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>MotoSession</title>
	<meta charset="utf-8">
</head>
<body>
 
	<?php

		$module = 'null';

		if (isset($_GET['module'])) {
			$module = $_GET['module'];
		}

		switch ($module) {

			case 'null': //Page d'entrée sur le site 
				?>
				<a href="index.php?module=CreationCompte">Je crée mon compte</a><br>
				<a href="index.php?module=Connexion">Je me connecte</a>
				<?php
			break;

			case 'CreationCompte':
				$controleurCreationCompte= new Module_CreationCompte();
				
			break;

			case 'Connexion': 
				$controleurConnexion = new Module_Connexion();
			break;

			

			
			//Affiche les formulaire de connexion
			case 'inscriptionMotard': //Affiche le formulaire de création de compte pour les motards
				$Module = new Module_Connexion();
				$Module->getControleur()->getVue()->afficheFormulaireCreationCompte();
			break;

			case 'inscriptionGerant': //Affiche le formulaire de création de compte pour les gérants de circuits
				$Module = new Module_Connexion();
				//TODO
			break;
				
		}

	?>
</body>
</html>	