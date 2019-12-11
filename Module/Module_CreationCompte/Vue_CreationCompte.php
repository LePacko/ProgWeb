<?php 
	

	class Vue_CreationCompte {

		function __construct() {
			
		}

		function FormulaireCreationCompteMotard() {
			include("./Html/FormulaireMotard.html");
		}

		function FormulaireCreationCompteGerant() {
			include("./Html/FormulaireGerant.html");
		}

	}
		
?>