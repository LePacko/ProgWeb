<?php 
	
	require_once"./Module_CreationCompte/Modele_CreationCompte.php";
	require_once"./Module_CreationCompte/Vue_CreationCompte.php";


	class Controleur_CreationCompte {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_CreationCompte();
			$this->Modele = new Modele_CreationCompte();
		}

		function getVue() {
			return $this->Vue;
		}

		function getModele() {
			return $this->Modele;
		}

		
	}


?>