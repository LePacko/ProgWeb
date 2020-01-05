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
					$tableauCircuit = $this->Modele->ListeCircuit();
					$this->Vue->ListeCircuit($tableauCircuit);
				break;

				case 'SessionEffectue':
					$sessioneffectuer = $this->Modele->SessionEffectuer();
					$this->Vue->SessionEffectuer($sessioneffectuer);
				break;

				case 'formulaireAjoutMoto':
				$this->Vue->formulaireAjoutMoto();
				break;	

				case 'ajoutMoto':
				$this->Modele->ajoutMoto();
				break;

				case'mesMotos':
				$this->Vue->afficherMesMotos($this->Modele->recupererMoto());
				break;

				case 'supprimerMoto':
				$this->Vue->avertissementSupression();
				break;

				case 'suppressionMotoOk':
				$this->Modele->supprimerMoto();
				break;

				case 'Circuit' :
					$sessions = $this->Modele->Circuit();
					$this->Vue->Circuit($sessions);
				break;

				case 'ReserverSession' :
					$placedisponible = $this->Modele->ReserverSession();
					$this->Vue->ReserverSession($placedisponible);
				break;

				
			}
			
		}
	
	}


?>