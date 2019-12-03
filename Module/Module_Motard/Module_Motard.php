<?php 

	require_once("./Module/Module_Motard/Controleur_Motard.php");
	
	class Module_Motard {
		
		private $Controleur;

		function __construct() {
			$this->Controleur = new Controleur_Motard();
			$this->Controleur->menu();
		}

	}


?>