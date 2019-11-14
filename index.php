<?php 
	require_once"./Module_Connexion/Module_Connexion.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

	

	<?php 

		$action = 'null';

		if (isset($_GET['action'])) {
			$action = $_GET['action'];
		}

		switch ($action) {

			case 'null':
				?>
				<a href="index.php?action=inscription">Je crée mon compte</a>
				<?php
			break;

			case 'inscription':
				$Module = new Module_Connexion();
				$Module->getControleur()->getVue()->afficheFormulaireCreationCompte();
			break;
				
		}

	?>
</body>
</html>