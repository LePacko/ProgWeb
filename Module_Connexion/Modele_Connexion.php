<?php 
	

	class Modele_Connexion {

		function __construct() {
			
		}

		function AjoutUtilisateurBasseDeDonnées($nom, $prenom, $mail, $hashedPsw) {

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
		}

	}


?>