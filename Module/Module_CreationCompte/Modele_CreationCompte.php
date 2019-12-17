<?php 
	
	include_once("./Connexion.php"); 


	class Modele_CreationCompte extends Connexion   {

		function __construct() {
			parent::init(); // connexion à la base de donnée 
			
		}

		function AjoutUtilisateurBaseDeDonnées() {

			//Récupération des vaiables entrée dans le formulaire 
			$prenom = $_POST['Prenom'];
			$nom = $_POST['Nom'];
			$mail = $_POST['Mail'];
			$mdp = hash('sha256', $_POST['MotDePasse']);			
			
			$adresse = $_POST['Adresse'];
			$codepostal = $_POST['CodePostal'];
			$numerotel = $_POST['NumeroTel'];
			$permis = $_POST['Permis'];
				
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO motard (nom,Prenom,adresse,code_postal,mail,numero_de_tel,permis,mdp) values (:nom,:prenom,:adresse,:code_postal,:mail,:numero_de_tel,:permis,:mdp)');
			$req->execute(array(
				'prenom' => $prenom,
				'nom' => $nom,
				'adresse' => $adresse,
				'code_postal' =>$codepostal,
				'mail' => $mail,
				'numero_de_tel' => $numerotel,
				'permis' => $permis,
				'mdp' => $mdp
			));
		}

		function AjoutGerantBaseDeDonnées() {
			//Récupération des vaiables entrée dans le formulaire 
			$denomination = $_POST['Denomination'];
			$mail = $_POST['Mail'];		
			$mdp = hash('sha256', $_POST['MotDePasse']);
			$siret = $_POST['Siret'];
			$adresse = $_POST['Adresse'];
			$codepostal = $_POST['CodePostal'];
			$numerotel = $_POST['NumeroTel'];

			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO entreprise (SIRET,denomination,adresse,code_postale,numero_tel,mdp,mail_entreprise) values (:siret,:denomination,:adresse,:codepostale,:numerotel,:mdp,:mail)');
			$req->execute(array(
				'siret'=> $siret,
				'denomination'=> $denomination,
				'adresse'=> $adresse,
				'codepostale'=> $codepostal,
				'numerotel'=> $numerotel,				
				'mdp'=> $mdp,
				'mail'=> $mail								
			));

		}

			

		

	}


?>