<?php 
	
	require_once("./Module/Module_Motard/Modele_Motard.php");
	require_once("./Module/Module_Motard/Vue_Motard.php");


	class Controleur_Motard {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Motard();
			$this->Modele = new Modele_Motard();
		}


        function voirProfil () {
			$this->Vue->afficherProfil();
		}
				 
		function trouverSession () {
			$tableauCircuit = $this->Modele->ListeCircuit();
			$this->Vue->ListeCircuit($tableauCircuit);

			$avis = $this->Modele->Avis($tableauCircuit);
			$this->Vue->Avis($avis);
		}

		function SessionEffectue() {
			$sessionReserver = $this->Modele->SessionReserver();
			$this->Vue->SessionReserver($sessionReserver);
		}

		function formulaireAjoutMoto () {
		$this->Vue->formulaireAjoutMoto($this->Modele->recupererMarqueMoto());
		}

		function ajoutMoto (){
		$this->Modele->ajoutMoto();
		}

		function mesMotos (){
		$this->Vue->afficherMesMotos($this->Modele->recupererMoto());
		}

		function supprimerMoto () {
		$this->Vue->avertissementSupression();
		}

		function suppressionMotoOk (){
		$this->Modele->supprimerMoto();
		}

		function Circuit () {   
			$sessions = $this->Modele->Circuit();
			
			$this->Vue->Circuit($sessions);
			
		}

		function ReserverSession () {
			$placedisponible = $this->Modele->ReserverSession();
			$this->Vue->ReserverSession($placedisponible);
			
			
		}

		
	
	}


?>