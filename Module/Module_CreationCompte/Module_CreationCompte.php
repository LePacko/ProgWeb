<?php 

	require_once("./Module/Module_CreationCompte/Controleur_CreationCompte.php");
	
	class Module_CreationCompte {
		
		private $Controleur;

		function __construct() {
			if (!defined('CONST_INCLUDE'))
				die('Acc�s direct interdit');

			$this->Controleur = new Controleur_CreationCompte();
			
			
			$action = 'null';
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			}	
			
			switch($action){

				case 'inscriptionMotard':// Affiche le formulaire d'inscription pour les nouveau motards
					$this->Controleur->inscriptionMotard(); 
				break;

				case 'inscriptionGerant':// Affiche le formulaire d'inscription pour les nouveau g�rants
					$this->Controleur->inscriptionGerant(); 
				break;

				case 'ajoutMotardBD'://Ajout d'un nouveau Motard dans la basse de donn�es
					$this->Controleur->ajoutMotardBD(); 
				break;

				case 'ajoutGerantBD'://Ajout d'un nouveau Gerant dans la basse de donn�es
					$this->Controleur->ajoutGerantBD(); 
				break;
				
			}
		}
	}


?>