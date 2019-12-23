<?php 
	
	require_once("./Module/Module_Motard/Modele_Motard.php");
	require_once("./Module/Module_Motard/Vue_Motard.php");


	class Controleur_Motard {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Motard();
			$this->Modele = new Modele_Motard();
		}

		function menu() {
			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {

                case 'voirProfil':
					$this->Vue->afficherProfil();
				break;
				 
				case 'trouverSession':
					$tableauCircuit = $this->Modele->Circuit();
					$this->Vue->afficherCircuit($tableauCircuit);
				break;

				case 'effectue':
					$sessioneffectuer = $this->Modele->SessionEffectuer();
					$this->Vue->SessionEffectuer($sessioneffectuer);
				break;

			}
			
		}
	
	}


?>