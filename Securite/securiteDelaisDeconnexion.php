<?php

	if(isset($_SESSION['derniere_action'])) {
		if ($_SESSION['derniere_action'] + (60*15) >time()  ) { 
			
		$_SESSION['derniere_action']=time();
				
		/*= heure actuelle + 5 min */

		/* donc dans ce cas, la dernière action date de moins de 15 minutes */

		//$_SESSION['derniere_action'] = time(); // mise à jour de la variable

		} 
		else {		
			FonctionsUtiles::msgBox("Delais session depasse");
			FonctionsUtiles::redirectionPageDelai("index.php?module=Connexion&action=deconnexion");
			
		}
		/* derniere action vielle de plus de 15 minutes => deconexion */

		/* DONC renvoi vers la page "deconnexion" */
			
	} 
?>