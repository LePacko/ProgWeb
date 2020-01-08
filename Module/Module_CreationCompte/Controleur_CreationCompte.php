<?php 
	
	require_once("./Module/Module_CreationCompte/Modele_CreationCompte.php");
	require_once("./Module/Module_CreationCompte/Vue_CreationCompte.php");


	class Controleur_CreationCompte {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_CreationCompte();
			$this->Modele = new Modele_CreationCompte();
		}

		function inscriptionMotard() {// Affiche le formulaire d'inscription pour les nouveau motards
			$this->Vue->FormulaireCreationCompteMotard(); 
		}

		function inscriptionGerant() {// Affiche le formulaire d'inscription pour les nouveau gérants
			$this->Vue->FormulaireCreationCompteGerant(); 
		}

		function ajoutMotardBD() {//Ajout d'un nouveau Motard dans la basse de données
			$this->Modele->AjoutUtilisateurBaseDeDonnées();
		}

		function ajoutGerantBD() {//Ajout d'un nouveau Gerant dans la basse de données
			$this->Modele->AjoutGerantBaseDeDonnées();
		}
			
		
	}

?>