<?php 
	
include_once("./ConnexionBD_iut.php");
	class Modele_Connexion extends ConnexionBD_iut {

		function __construct() {
			parent::init();
			
		}

		function validerConnexion ($login, $mdp) {
			$sql = 'SELECT id_motard from motard where mail like :login and mdp like :mdp';
			$req = parent::$connexion-> prepare($sql);
			$req -> bindParam(':login', $login);
			$req -> bindParam(':mdp', $mdp);
			$req -> execute();
			$res = $req -> fetch();
			//$_SESSION["id"] = $res[0];
			if(!isset($res[0])){
				$sql2 = 'SELECT SIRET from entreprise where mail_entreprise like :login and mdp like :mdp';
				$req2 = parent::$connexion -> prepare($sql2);
				$req2 -> bindParam(':login', $login);
				$req2 -> bindParam(':mdp', $mdp);
				$req2 -> execute();
				$res2 = $req2-> fetch();

				if(!isset($res2[0])){
				echo"identifiant ou mot de passe incorrect";
				}
				else {
					echo "je suis co";
					$_SESSION["siret"] = $res2[0];
				}
			}
			else{
				echo "je suis co";
				$_SESSION["id"] = $res[0];
			}

			
		}

		function recupererDonneesProfil() {
			if(isset($_SESSION['id'])) {
				$sql = 'SELECT id_motard,nom,prenom from motard where id_motard = :login ';
				$req = parent::$connexion-> prepare($sql);
				$req -> bindParam(':login', $_SESSION['id']);
				$req -> execute();
				$res = $req -> fetchAll();
				return $res;
			}

			else {

			}
		}
	}


?>