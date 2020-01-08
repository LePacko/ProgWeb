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


		function formConnexion () {
			$this->Vue->formulaireConnexion();
		}

		function connexion () {
			$login = htmlspecialchars($_POST['id']);
			$mdp = hash('sha256', $_POST['mdp']);
			$this -> Modele -> validerConnexion($login,$mdp);
		}
					
		function deconnexion() {
			if(isset($_SESSION['session_motard'])){
				unset($_SESSION['session_motard']);
			}
			if(isset($_SESSION['session_gerant'])){
				unset($_SESSION['session_gerant']);
			}
		}

		function profil() {
			$tab=$this->Modele->recupererDonneesProfil();
			$this->Vue->afficherProfil($tab);
		}
		
	
	}


?>