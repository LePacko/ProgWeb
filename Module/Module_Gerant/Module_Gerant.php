<?php 

	require_once("./Module/Module_Gerant/Controleur_Gerant.php");
	
	class Module_Gerant {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_Gerant();
			$this->Controleur->menu();
		}

	}


?>