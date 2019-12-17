<?php 
	
include_once("./Connexion.php");

	class Modele_Gerant extends Connexion {

		function __construct() {
			parent::init();
			
		}
		function AjoutCircuit() {

			//Récupération des vaiables entrée dans le formulaire 
			
			$adresse = $_POST['adresse'];		
			$code_postale = $_POST['code_postale'];
			$longueur = $_POST['longueur'];
			$nom = $_POST['nom'];
			$image_circuit =null;
			$siret=$_SESSION['siret'];
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO circuit (adresse,code_postale,longueur,nom,Siret) values (:adresse,:code_postale,:longueur,:nom,:SIRET)');
			$req->execute(array(
				'adresse' => $adresse,
				'code_postale' => $code_postale,
				'longueur' => $longueur,
				'nom' =>$nom,
				'SIRET' => $siret
			));

		}

	}


?>