<?php

Class FonctionsUtiles {

	public static function msgBox ($texteAfficher) {
		echo'<script type="text/javascript">
		$(document).ready(function(){
			alert("'.$texteAfficher.'");
		});  
		</script>';
	}

	public static function redirectionPage ($url) {
		echo '<META http-equiv="refresh" content="0; URL='.$url.'">';
	}

	public static function redirectionFormulaireAjoutMoto () {
		echo '<META http-equiv="refresh" content="0; URL=index.php?module=Motard&action=formulaireAjoutMoto">';
	}
}