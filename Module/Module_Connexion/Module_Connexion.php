<?php 

	require_once("./Module/Module_Connexion/Controleur_Connexion.php");
	
	class Module_Connexion {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_Connexion();
			$this->Controleur->menu();
		}

	}


?>