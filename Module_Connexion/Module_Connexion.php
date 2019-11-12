<?php 

	require_once"./Module_Connexion/Controleur_Connexion.php";
	
	class Module_Connexion {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_Connexion();
		}

		function getControleur() {
			return $this->Controleur;
		} 
	}


?>