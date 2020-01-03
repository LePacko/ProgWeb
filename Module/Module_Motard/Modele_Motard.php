<?php 
	
include_once("./Connexion.php");
include_once("./FonctionsUtiles.php");
	class Modele_Motard extends Connexion {

		function __construct() {
			parent::init();
			
		}

		function ListeCircuit() {

			$req = parent::$connexion->prepare('select * from circuit');
			$req -> execute();
			$res = array (
				"nom"  => array(),
				"adresse" => array(),
				"codePostale" => array(),
				"longeur" => array(),
				"imageCircuit" => array(),
				"siret" => array()
			);

			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['nom'];
				$res[$i][1] = $donne['adresse'];
				$res[$i][2] = $donne['code_postale'];
				$res[$i][3] = $donne['longueur'];
				$res[$i][4] = $donne['image_circuit'];
				$res[$i][5] = $donne['SIRET'];
				$res[$i][6] = $donne['id_circuit'];
				
				$i ++;
			}
			
			$req->closeCursor();

			return $res;			
		}

		function SessionEffectuer() {

			$id = $_SESSION['id'];

			$req = parent::$connexion->prepare('select * from effectuer where id_motard = '.$_SESSION['id']);
			$req->execute();

			$res = array(
				"session" => array(),
				"tempTour"=> array()
			);

			$i=0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['id_session'];
				$res[$i][1] = $donne['temps_tour'];				
				$i ++;
			}

			$req->closeCursor();

			return $res;
			

		}

		function recupererMoto() {
		$id_motard=$_SESSION['id'];
		$requete = "SELECT * from moto where id_motard ='$id_motard'";
		$resultat = parent::$connexion->query($requete);
		
		return $resultat;
		}

		function supprimerMoto () {
		
			if(isset($_POST['id']) && $_POST['id']!='') {
				$immatriculation = $_POST['id'];  
				echo $immatriculation;
				$requete = "delete from moto where immatriculation ='$immatriculation'";
				$resultat = parent::$connexion->query($requete);
				

			}
		
			header('location:index.php?module=Motard&action=mesMotos');
			
		}

		function ajoutMoto () {
			$resultat = $this->recupererMoto();
			$tab = $resultat->fetchAll();

			if(count($tab)<3) { // le nombre maximum de moto a été fixé a 3 mais peut evoluer.

				//Récupération des vaiables entrée dans le formulaire 
				$immatriculation = $_POST['Immat'];
				$annee = (int)$_POST['Annee'];	
				$marque = $_POST['Marque'];
				$modele= $_POST['Modele'];
				$id_motard=(int)$_SESSION['id'];
			
				// on teste si l'immatriculation de la moto que l'utilisateur souhaite ajouter est disponible
				$sql = 'SELECT * from moto where immatriculation like :immat';
				$req3 = parent::$connexion -> prepare($sql);
				$req3 -> bindParam(':immat', $immatriculation);
				$req3 -> execute();
				$testImmat = $req3-> fetch();

				if(isset($testImmat[0])){
					FonctionsUtiles::msgBox("La plaque d\'immatriculation renseignee est deja utilise par un autre motard");
					FonctionsUtiles::redirectionFormulaireAjoutMoto();
				}
			
				else {
				// on teste si la moto que l'utilisateur souhaite ajouter existe bien dans la bd (marque et modele)
				$sql2 = 'SELECT * from modele_moto where modele like :modele and marque like :marque';
				$req2 = parent::$connexion -> prepare($sql2);
				$req2 -> bindParam(':modele', $modele);
				$req2 -> bindParam(':marque', $marque);
				$req2 -> execute();
				$testModeleExistant = $req2-> fetch();

					if(!isset($testModeleExistant[0])){
						FonctionsUtiles::msgBox("La moto n\'existe pas dans notre BD");
						FonctionsUtiles::redirectionFormulaireAjoutMoto();
					
					}
			
					else {
					//Ajout de la nouvelle moto dans le abase de donées
					$req = parent::$connexion->prepare('INSERT INTO moto (immatriculation,annee,id_motard,marque,modele) values (:immat,:annee,:id_motard,:marque,:modele)');
					$req->execute(array(
					'immat'=> $immatriculation,
					'id_motard'=> $id_motard,  // qui correspond à l'id du motard connecté
					'marque'=> $marque,
					'annee'=> $annee,
					'modele'=> $modele		
								
					));
					FonctionsUtiles::msgBox("La moto a ete ajoutee avec succes");
					FonctionsUtiles::redirectionFormulaireAjoutMoto();
					}
				}
			}

			else{FonctionsUtiles::msgBox("vous avez atteint le nombre maximum de moto");}
		}

		function Circuit() {

			//Recupération des informations concernant le circuit
			$IdCircuit = $_GET['IdCircuit'];
			$reqCircuit = parent::$connexion->prepare('select * from circuit where id_circuit = '.$IdCircuit);
			$reqCircuit->execute();

			//Recupération date et heure actuel 
			$annee = date("Y");
			$mois = date("m");
			$jour = date ("d");
			$date_actuel = date("Y-m-d");
			echo $date_actuel."<br>";
			$heure = date("G");
			$minute = date("i");

			  
			$res = array(//Initialisation du tableau 
				"id_session" => array(),
				"nbplace" => array()
			);

			//Recuperation des sessions a venir et insertion dans le tableau res sur ce circuit pas le meme jour 
			$req1 = 'select * from session where date > '.'"'.$date_actuel.'"
			and id_circuit= '.$IdCircuit;
			$reqSession = parent::$connexion->prepare($req1);
			$reqSession->execute();

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['id_session'];
				$res[$i][1] = $donne['nb_place'];		
				$i ++;
			}

			//Recuperation des sessions a venir et insertion dans le tableau res sur ce circuit le meme jopur mais plus tard 
			$req2 = 'select * from session where date = '.'"'.$date_actuel.'"
			and id_circuit = '.$IdCircuit.' and heure_debut >'.$heure;
			$reqSession = parent::$connexion->prepare($req2);
			$reqSession->execute();

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['id_session'];
				$res[$i][1] = $donne['nb_place'];		
				$i ++;
			}

			return $res;




		}
	}
?>