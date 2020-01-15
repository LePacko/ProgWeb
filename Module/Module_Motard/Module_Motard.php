<?php 

	require_once("./Module/Module_Motard/Controleur_Motard.php");
	
	class Module_Motard {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_Motard();

			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {

                case 'voirProfil':
					$this->Controleur->voirProfil();
				break;
				 
				case 'trouverSession':
					$this->Controleur->trouverSession();
				break;

				case 'SessionEffectue':
					$this->Controleur->SessionEffectue();
				break;

				case 'formulaireAjoutMoto':
				$this->Controleur->formulaireAjoutMoto();
				break;	

				case 'ajoutMoto':
				$this->Controleur->ajoutMoto();
				break;

				case'mesMotos':
				$this->Controleur->mesMotos();
				break;

				case 'supprimerMoto':
				$this->Controleur->supprimerMoto();
				break;

				case 'suppressionMotoOk':
				$this->Controleur->suppressionMotoOk();
				break;

				case 'Circuit' :
					$this->Controleur->Circuit();
				break;

				case 'ReserverSession' :
					$this->Controleur->ReserverSession();
				break;

				case 'EnvoyerAvis' : 
					$this->Controleur->EnvoyerAvis();
				break;

			}
		}
	}


?>