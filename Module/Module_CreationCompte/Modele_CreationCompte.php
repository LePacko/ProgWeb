<?php 
	

	class Modele_CreationCompte {

		function __construct() {
			
		}

		function AjoutUtilisateurBasseDeDonnées($nom, $prenom, $mail, $hashedPsw, $adresse, $codepostal, $numerotel, $permis) {

			//Message de bienvenue a mettre dans une fonction
			echo "Bonjour ".$prenom."\n";
			echo $nom."\n<br>";
				
			//Conexion à la base de donées 
			try {
				$connexion = new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','');
			}
			catch(Exception $e) {
				echo "erreur";
			}
				
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = $connexion->prepare('insert into motard (nom,Prenom,adresse,code_postal,mail,numero_de_tel,permis,mdp) values (:nom,:prenom,:adresse,:code_postal,:mail,:numero_de_tel,:permis,:mdp)');
			$req->execute(array(
				'prenom' => $prenom,
				'nom' => $nom,
				'adresse' => $adresse,
				'code_postal' =>$codepostal,
				'mail' => $mail,
				'numero_de_tel' => $numerotel,
				'permis' => $permis,
				'mdp' => $hashedPsw
			));
		}

	}


?>