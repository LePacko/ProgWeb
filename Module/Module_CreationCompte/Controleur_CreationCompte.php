<?php 
	
	require_once("./Module/Module_CreationCompte/Modele_CreationCompte.php");
	require_once("./Module/Module_CreationCompte/Vue_CreationCompte.php");


	class Controleur_CreationCompte {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_CreationCompte();
			$this->Modele = new Modele_CreationCompte();
		}

		function menu() {
			
			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}	
			
			switch($action){

				case 'inscriptionMotard':// Affiche le formulaire d'inscription pour les nouveau motards
					$this->Vue->FormulaireCreationCompteMotard(); 
				break;

				case 'inscriptionGerant':// Affiche le formulaire d'inscription pour les nouveau gérants
					$this->Vue->FormulaireCreationCompteGerant(); 
				break;

				case 'ajoutMotardBD'://Ajout d'un nouveau Motard dans la basse de données
					$this->Modele->AjoutUtilisateurBaseDeDonnées();
				break;

				case 'ajoutGerantBD'://Ajout d'un nouveau Gerant dans la basse de données
					$this->Modele->AjoutGerantBaseDeDonnées();
				break;
				
			}
			

		}
		
	}


?>