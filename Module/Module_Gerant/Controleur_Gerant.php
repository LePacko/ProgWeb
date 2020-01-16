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
		function acceuil(){
			//$info=$this->Model->acceuil();
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
			FonctionsUtiles::redirectionPage("index.php?module=Gerant&action=mescircuits");

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
			FonctionsUtiles::redirectionPage("index.php?module=Gerant&action=messessions");

		}
		function PageSession () {
			$info=$this->Modele->recupereSession();
			$infoMotard=$this->Modele->recupereInfoMotard();
			$this->Vue->InfoSession($info,$infoMotard);
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
			$this->Modele->modifieValide();
		}
		function modifieCircuit(){
			$info=$this->Modele->recupereCircuit();
			$this->Vue->modifieCircuit($info);

		}
		function modifieValideCircuit(){
			$this->Modele->modifieValideCircuit();
		}
		function modifieSession(){
			$info=$this->Modele->recupereSession();
			$this->Vue->modifieSession($info);

		}
		function modifieValideSession(){
			$this->Modele->modifieValideSession();
		}
	}


?>