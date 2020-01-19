<?php 

	require_once("./Module/Module_Connexion/Controleur_Connexion.php");
	

	class Module_Connexion {
		
		private $Controleur;

		function __construct() {
			if (!defined('CONST_INCLUDE'))
				die('Accès direct interdit');

			$this->Controleur = new Controleur_Connexion();

			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {

				case 'formConnexion' :
					$this->Controleur->formConnexion();
				break;

				case'connexion' :
					$this->Controleur->connexion();
				break;
					
				case'deconnexion':
					$this->Controleur->deconnexion();
				break;

				case'profil' :
					$this->Controleur->profil();
					break;
				default : 
					echo "Vous vous trouver sur une page inexistante";
				break;
			}

		}

	}


?>