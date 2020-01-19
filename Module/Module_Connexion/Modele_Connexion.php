<?php 
	
include_once("./Connexion.php");

	class Modele_Connexion extends Connexion {

		function __construct() {
			parent::init();
			
		}

		function testerConnexionMotard ($login, $mdp) {
			$sql = 'SELECT id_motard from motard where mail like :login and mdp like :mdp';
			$req = parent::$connexion-> prepare($sql);
			$req -> bindParam(':login', $login);
			$req -> bindParam(':mdp', $mdp);
			$req -> execute();
			$res = $req -> fetch();
			/*on teste d'abord si la personne souhaitant se connecter est un motard en recherchant dans la table
			motard si une adresse mail correspond au login de l'utilisateur qui essaye de se connecter, si ce n'est pas le cas
			on teste si il s'agit d'un gerant de circuit */

			return $res;
		}

		function testerConnexionGerant ($login, $mdp) {
				$sql2 = 'SELECT SIRET from entreprise where mail_entreprise like :login and mdp like :mdp';
				$req2 = parent::$connexion -> prepare($sql2);
				$req2 -> bindParam(':login', $login);
				$req2 -> bindParam(':mdp', $mdp);
				$req2 -> execute();
				$res2 = $req2-> fetch();

				return $res2; 		
		}

		function recupererDonneesProfil() {
			if(isset($_SESSION['session_motard'])) {
				$sql = 'SELECT id_motard,nom,prenom from motard where id_motard = :login ';
				$req = parent::$connexion-> prepare($sql);
				$req -> bindParam(':login', $_SESSION['session_motard']);
				$req -> execute();
				$res = $req -> fetchAll();
				return $res;
			}

			else {

			}
		}
	}


?>