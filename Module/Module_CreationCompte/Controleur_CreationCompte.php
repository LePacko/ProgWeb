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

					case 'inscriptionMotard' :
						$this->Vue->FormulaireCreationCompteMotard();
					break;

					case 'inscriptionGerant' :
						$this->Vue->FormulaireCreationCompteGerant(); // A faire
					break;

					case 'ajoutMotardBD'://Ajout d'un nouveau Motard dans la basse de données
						$this->Modele->AjoutUtilisateurBaseDeDonnées();
					break;
				
			}
			

		}
		
		function getVue() {
			return $this->Vue;
		}

		function getModele() {
			return $this->Modele;
		}

		
	}


?>