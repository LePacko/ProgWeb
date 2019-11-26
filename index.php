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
				include("./Html/index.html");
			break;

			case 'CreationCompte':
				$controleurCreationCompte = new Module_CreationCompte();
				
			break;

			case 'Connexion': 
				$controleurConnexion = new Module_Connexion();
			break;

			default : 
				echo "Error la page n'existe pas";
			break;
				
		}

	?>
</body>
</html>	