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
					$tableauCircuit = $this->Modele->Circuit();
					$this->Vue->Circuit($tableauCircuit);
				break;
				case 'formajout':
					include("./Html/FormulaireAjoutCircuit.html");
				break;
				case 'ajoutCircuit':
					$this->Modele->ajoutCircuit();
					echo'lol je fais ca';
				break;
				case 'messessions':
					$tableauSession = $this->Modele->Session();
					$this->Vue->Session($tableauSession);
				break;
				case 'formajoutSession':
					include("./Html/FormulaireAjoutSession.html");
				break;
				case 'ajoutSession':
					$this->Modele->ajoutSession();
					echo'lol je fais ca';
				break;
			}
			
		}
	
	}


?>