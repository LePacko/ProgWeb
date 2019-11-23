<?php 
	

	class Modele_CreationCompte {

		function __construct() {
			
		}

		function AjoutUtilisateurBaseDeDonnées() {

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

		function AjoutGerantBaseDeDonnées() {

			//Récupération des vaiables entrée dans le formulaire 
			$denomination = $_POST['Denomination'];
			$mail = $_POST['Mail'];
			$Mdp = $_POST['MotDePasse'];			
			$hashedPsw = crypt($Mdp);
			$Siret = $_POST['Siret'];
			$adresse = $_POST['Adresse'];
			$codepostal = $_POST['CodePostal'];
			$numerotel = $_POST['NumeroTel'];
		
			//Conexion à la base de donées 
			try {
				$connexion = new PDO('mysql:host=localhost;dbname=projet;charset=utf8','root','');
			}
			catch(Exception $e) {
				echo "erreur";
			}
				
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = $connexion->prepare('insert into entreprise (SIRET,denomination,adresse,code_postale,numero_tel,mdp,mail_entreprise) values (:siret,:denomination,:adresse,:codepostale,:numerotel,:mdp,:mail)');
			$req->execute(array(
				'siret'=> $Siret,
				'denomination'=> $denomination,
				'adresse'=> $adresse,
				'codepostale'=> $codepostal,
				'numerotel'=> $numerotel,				
				'mdp'=> $hashedPsw,
				'mail'=> $mail								
			));

		}

	}


?>