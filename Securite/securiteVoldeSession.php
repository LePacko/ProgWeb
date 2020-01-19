<?php

	
if (isset($_SESSION['ticket']) AND isset($_COOKIE['ticket']) AND !empty($_SESSION['ticket']) AND !empty($_COOKIE['ticket'])) {


	if ($_COOKIE['ticket'] == $_SESSION['ticket'])
	{
		// C'est reparti pour un tour : on créer un nouveau ticket 
		$ticket = session_id().microtime().rand(0,9999999999);
		$ticket = hash('sha512', $ticket);
		$_COOKIE['ticket'] = $ticket;
		$_SESSION['ticket'] = $ticket;
		
	}
	else
	{
		FonctionsUtiles::msgBox("On a tenter de vous voler votre session");
		FonctionsUtiles::redirectionPageDelai("index.php?module=Connexion&action=deconnexion");
	}
}

?>