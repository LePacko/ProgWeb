
	<?php
	require_once("./Module/Module_Connexion/Module_Connexion.php");
	require_once("./Module/Module_CreationCompte/Module_CreationCompte.php");
	require_once("./Module/Module_Motard/Module_Motard.php");
	require_once("./Module/Module_Gerant/Module_Gerant.php");

	
		if(!isset($_SESSION['login']) && !defined('CONST_INCLUDE')){
   	 	session_start();
    	define('CONST_INCLUDE',NULL);/*on definit une constante pour dire que l'on passe par l'index 
    auquel cas une alert se declenchera pour specifier que l'acces est interdit*/
		}
//on met en tampon tout les affichage (or template,module calculé...) qui se charge avant qu'il n'apparaissent

		ob_start();

if (isset($_GET['module'])) {
	switch ($_GET['module']) {
		case 'CreationCompte':
			$moduleCreationCompte = new Module_CreationCompte();
		break;
		case 'Connexion': 
			$moduleConnexion = new Module_Connexion();
		break;
		case 'Motard':
			$moduleMotard = new Module_Motard();
		break;
		case 'Gerant' : 
			$moduleGerant = new Module_Gerant();
		break;

				
		}
	}
		
		$module = ob_get_clean();//on recupere l'affichage des modules
		ob_start();    
		$menu = ob_get_clean();

		if(!isset($_SESSION['session_motard'])&&!isset($_SESSION['session_gerant'])){
			REQUIRE('Html/template/indexTemplateAvantConnexion.php');
		}

		else {
			include('./Html/template/IndexTemplateApresConnexion.php');
		}
	?>
</body>
</html>	