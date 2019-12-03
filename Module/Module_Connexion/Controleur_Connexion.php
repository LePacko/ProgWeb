<?php 
	
	require_once("./Module/Module_Connexion/Modele_Connexion.php");
	require_once("./Module/Module_Connexion/Vue_Connexion.php");


	class Controleur_Connexion {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Connexion();
			$this->Modele = new Modele_Connexion();
		}

		function menu() {
			
			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}

			switch($action) {

				case 'formConnexion' :
					$this->Vue->formulaireConnexion();
				break;

				case'connexion' :
					$login = htmlspecialchars($_POST['id']);
					$mdp = hash('sha256', $_POST['mdp']);
					$this -> Modele -> validerConnexion($login,$mdp);
			break;
					//$this->Modele->validerConnexion();
				case'deconnexion':
					if(isset($_SESSION['id'])){
						unset($_SESSION['id']);
					}
					if(isset($_SESSION['siret'])){
						unset($_SESSION['siret']);
					}
				break;

				case'profil' :
				$tab=$this->Modele->recupererDonneesProfil();
				$this->Vue->afficherProfil($tab);
				default : 
					echo "Vous vous trouver sur une page inexistante";
				break;

			}
		}
	
	}


?>