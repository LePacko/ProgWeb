<?php 
	
	require_once("./Module/Module_Connexion/Modele_Connexion.php");
	require_once("./Module/Module_Connexion/Vue_Connexion.php");
	include_once("./FonctionsUtiles.php");

	class Controleur_Connexion {
		
		private $Vue;
		private $Modele;

		function __construct() {
			$this->Vue = new Vue_Connexion();
			$this->Modele = new Modele_Connexion();
		}


		function formConnexion () {
			if(!isset($_SESSION['session_motard'])&&!isset($_SESSION['session_gerant'])) // impossibile d'afficher le formulaire de connexion si un utilisateur est deja connecter
				$this->Vue->formulaireConnexion();
		}

		function connexion () {
			$login = htmlspecialchars($_POST['id']); // contre les failles XXS
			$mdp = hash('sha256', htmlspecialchars($_POST['mdp']));
			$resultatMotard = $this->Modele->testerConnexionMotard($login,$mdp); // contenant l'id du motard qui souhaite se connecter si le login et le mdp sont correct
			/*on teste d'abord si la personne souhaitant se connecter est un motard en recherchant dans la table
			motard si une adresse mail correspond au login de l'utilisateur qui essaye de se connecter, si ce n'est pas le cas
			on teste si il s'agit d'un gerant de circuit */

			if(!isset($resultatMotard[0])) { 
				$resultatGerant = $this->Modele->testerConnexionGerant($login,$mdp);
				if (!isset($resultatGerant[0])){
				// si encore une fois il n'y a rien dans le resultat de la requete c'est donc qu'il n'y a pas de correspondance entre le login et le mot de passe saisie dans la bd
					FonctionsUtiles::msgBox("identifiant ou mot de passe incorrect");
				}
				else { 
				// sinon il s'agit d'un gerant de circuit est on affecte ï¿½ une variable de session le numero siret du gerant qui est une cle unique
					
					$_SESSION['session_gerant'] = $resultatGerant[0];
					$_SESSION['derniere_action'] = time();
				}
			}

			else {
				// si on entre dans ce else c'est que le resultat de la premiere requete a retourne quelquechose donc il s'agit d'un motard bien present dans la bd
				
				$_SESSION['session_motard'] = $resultatMotard[0];
				$_SESSION['derniere_action'] = time();
			}
		}
					
		function deconnexion() {
		// On détruit la session  en vidant toute les varriables de session
			$_SESSION = array();
			session_destroy();
		}

		function profil() {
			$tab=$this->Modele->recupererDonneesProfil();
			$this->Vue->afficherProfil($tab);
		}
		
	
	}


?>