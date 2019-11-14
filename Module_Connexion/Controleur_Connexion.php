<?php 
	
	require_once"./Module_Connexion/Modele_Connexion.php";
	require_once"./Module_Connexion/Vue_Connexion.php";


	class Controleur_Connexion {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Connexion();
			$this->Modele = new Modele_Connexion();
		}

		function getVue() {
			return $this->Vue;
		}

		function getModele() {
			return $this->Modele;
		}
	}


?>