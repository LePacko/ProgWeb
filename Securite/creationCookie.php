<?php
include_once("./FonctionsUtiles.php");

	$cookie_name = "ticket";
	// On g�n�re quelque chose d'al�atoire
	$ticket = session_id().microtime().rand(0,9999999999);
	// on hash pour avoir quelque chose de propre qui aura toujours la m�me forme
	$ticket = hash('sha512', $ticket);

	// On enregistre des deux cot�s
	setcookie($cookie_name, $ticket, time() + (60 * 30)); // Expire au bout de 30 min
			
	if(!isset($_COOKIE[$cookie_name])) {
	// Le navigateur ne semble pas accepter les cookies donc on ne rentre pas dans le else 
	//et on ne gere pas le Vol de session
	
	FonctionsUtiles::msgBox("non prise en charge des cookies par le naviguateur");
			
	}
				
	else{
	$_SESSION['ticket'] = $_COOKIE['ticket'];

	//echo("prise en charge des cookies par le naviguateur");
		
	}

?>