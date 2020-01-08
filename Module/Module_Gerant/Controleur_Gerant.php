<?php 
	
	require_once("./Module/Module_Gerant/Modele_Gerant.php");
	require_once("./Module/Module_Gerant/Vue_Gerant.php");


	class Controleur_Gerant {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Gerant();
			$this->Modele = new Modele_Gerant();
		}
		function profil () {
			echo'profil';
		}

		function mescircuits() {
			$tableauCircuit = $this->Modele->Circuit();
			$this->Vue->Circuit($tableauCircuit);
		}
		function afficherFormulaireAjoutCircuit () {
			include("./Html/FormulaireAjoutCircuit.html");
		}
		function ajoutCircuit () {
			$this->Modele->ajoutCircuit();
		}
		function messessions() {
			$tableauSession = $this->Modele->Session();
			$this->Vue->Session($tableauSession);
		}
		function formajoutSession () {
			include("./Html/FormulaireAjoutSession.php");
		}
		
		function ajoutSession() {
			$this->Modele->ajoutSession();
		}
		
			
		
	
	}


?>