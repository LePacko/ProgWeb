<?php 

	require_once("./Module/Module_CreationCompte/Controleur_CreationCompte.php");
	
	class Module_CreationCompte {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_CreationCompte();;
		}

		function getControleur() {
			return $this->Controleur;
		} 
	}


?>