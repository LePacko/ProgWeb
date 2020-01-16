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
		echo '<META http-equiv="refresh" content="2; URL='.$url.'">';
	}
	public static function redirectionPageDelai ($url) {
		echo '<META http-equiv="refresh" content="2; URL='.$url.'">';
	}

	public static function redirectionFormulaireAjoutMoto () {
		echo '<META http-equiv="refresh" content="2; URL=index.php?module=Motard&action=formulaireAjoutMoto">';
	}

	public static function RetourPagePrecedente() {
		?><a class='bouttonretour' href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a><?php
	}

}