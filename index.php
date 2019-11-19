<?php 
	require_once"./Module_Connexion/Module_Connexion.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>MotoSession</title>
	<meta charset="utf-8">
</head>
<body>

	<?php 

		$action = 'null';

		if (isset($_GET['action'])) {
			$action = $_GET['action'];
		}

		switch ($action) {

			case 'null': //Page d'entrée sur le site 
				?>
				<a href="index.php?action=choixTypeUtilisateurCrationCompte">Je crée mon compte</a><br>
				<a href="index.php?action=choixTypeUtilisateurConnexion">Je me connecte</a>
				<?php
			break;

			case 'choixTypeUtilisateurCrationCompte'://Choix de Type d'utilisateur pour crée un compte 
				?>
				<a href="index.php?action=inscriptionMotard">Je suis un motard</a><br>
				<a href="index.php?action=inscriptionGerant">Je suis un gérant de circuit</a>
				<?php
			break;

			case 'ajoutMotardBD':
				//Récupération des vaiables entrée dans le formulaire 
				$prenom = $_POST['Prenom'];
				$nom = $_POST['Nom'];
				$mail = $_POST['Mail'];
				$Mdp = $_POST['MotDePasse'];
				$hashedPsw = crypt($Mdp);
				$adresse = $_POST['Adresse'];
				$codepostal = $_POST['CodePostal'];
				$numerotel = $_POST['NumeroTel'];
				$permis = $_POST['Permis'];
				//Ajout d'un nouveau Motard dans la basse de données
				$Module = new Module_Connexion();
				$Module->getControleur()->getModele()->AjoutUtilisateurBasseDeDonnées($nom, $prenom, $mail, $hashedPsw, $adresse, $codepostal, $numerotel, $permis);
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