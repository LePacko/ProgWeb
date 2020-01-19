<?php 

	require_once("./Module/Module_Gerant/Controleur_Gerant.php");
	
	class Module_Gerant {
		
		private $Controleur;

		function __construct() {
			if (!defined('CONST_INCLUDE'))
				die('Accès direct interdit');
			$this->Controleur = new Controleur_Gerant();
			

			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {
				case 'acceuil':
					$this->Controleur->acceuil();
				break;
				case 'profil':
                	$this->Controleur->profil();
				 break;

				case 'mescircuits':
					$this->Controleur->mescircuits();
				break;

				case 'formulaireAjoutCircuit':
					$this->Controleur->afficherFormulaireAjoutCircuit();
				break;

				case 'ajoutCircuit':
					$this->Controleur->ajoutCircuit();

				break;

				case 'messessions':
					$this->Controleur->messessions();
				break;

				case 'formajoutSession':
					$this->Controleur->formajoutSession();
				break;

				case 'ajoutSession':
					$this->Controleur->ajoutSession();
				break;

				case 'PageSession':
					$this->Controleur->PageSession();
				break;
				case 'PageCircuit':
					$this->Controleur->PageCircuit();
				break;
				case 'modifieProfil':
					$this->Controleur->modifieProfil();
				break;
				case 'modifieValide':
					$this->Controleur->modifieValide();
				break;
				case 'modifieCircuit':
					$this->Controleur->modifieCircuit();
				break;
				case 'modifieValideCircuit':
					$this->Controleur->modifieValideCircuit();
				break;
				case 'modifieSession':
					$this->Controleur->modifieSession();
				break;
				case 'modifieValideSession':
					$this->Controleur->modifieValideSession();
				break;

			}
		}

	}


?>