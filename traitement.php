<!DOCTYPE html>
<html>
<head>
	
</head>
<body>

	<?php

		//Récupération des vaiables entrée dans le formulaire 
		$prenom = $_POST['Prenom'];
		$nom = $_POST['Nom'];
		$mail = $_POST['Mail'];
		$Mdp = $_POST['MotDePasse'];
		$hashedPsw = crypt($Mdp);
		
		//Message de bienvenue a mettre dans une fonction
		echo "Bonjour ".$prenom."\n";
		echo $nom."\n<br>";
			
		//Conexion à la base de donées 
		try {
			$connexion = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
		}
		catch(Exception $e) {
			echo "erreur";
		}
			
		//Ajout du nouvelle utilisateur dans le abase de donées
		$req = $connexion->prepare('insert into motard (prenom,nom,mail,mdp) values (:nom,:prenom,:mail,:mdp)');
		$req->execute(array(
			'prenom' => $prenom,
			'nom' => $nom,
			'mail' => $mail,
			'mdp' => $hashedPsw
		));


	?>

</body>
</html>
