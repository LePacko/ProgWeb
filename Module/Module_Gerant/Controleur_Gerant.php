<?php 
	
	require_once("./Module/Module_Gerant/Modele_Gerant.php");
	require_once("./Module/Module_Gerant/Vue_Gerant.php");


	class Controleur_Gerant {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Gerant();
			$this->Modele = new Modele_Gerant();
		}

		function menu() {
			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {

                case 'profil':
                	echo'bite';
				 break;
				case 'mescircuits':
					
				break;
				case 'formajout':
					include("./Html/FormulaireAjoutCircuit.html");
				break;
				case 'ajoutCircuit':
					$this->Modele->ajoutCircuit();
					echo'lol je fais ca';
				break;
			}
			
		}
	
	}


?>