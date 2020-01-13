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
			$info=$this->Modele->profil();
			$this->Vue->afficheProfil($info);
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
		function PageSession () {
					$info=$this->Modele->recupereSession();
					$this->Vue->InfoSession($info);
		}
		function PageCircuit () {
			$info=$this->Modele->recupereCircuit();
			$this->Vue->InfoCircuit($info);
		}
		function modifieProfil(){
			$info=$this->Modele->profil();
			$this->Vue->modifieProfil($info);

		}
		function modifieValide(){
			$info=$this->Modele->modifieValide();
			$this->Vue->modifieProfil($info);

		}
	}


?>