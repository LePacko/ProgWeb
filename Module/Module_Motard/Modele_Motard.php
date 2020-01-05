<?php 
	
include_once("./Connexion.php");

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

		function ajoutMoto () {

			//R�cup�ration des vaiables entr�e dans le formulaire 
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
				echo"L'immatriculation est d�j� utilis�e par un autre motard";
				
			}
			
			else {
			// on teste si la moto que l'utilisateur souhaite ajouter existe bien dans la bd
			$sql2 = 'SELECT * from modele_moto where modele like :modele and marque like :marque';
			$req2 = parent::$connexion -> prepare($sql2);
			$req2 -> bindParam(':modele', $modele);
			$req2 -> bindParam(':marque', $marque);
			$req2 -> execute();
			$testModeleExistant = $req2-> fetch();

				if(!isset($testModeleExistant[0])){
					echo'La moto n\'existe pas dans notre BD';
					
				}
			
				else {
				//Ajout de la nouvelle moto dans le abase de don�es
				$req = parent::$connexion->prepare('INSERT INTO moto (immatriculation,annee,id_motard,marque,modele) values (:immat,:annee,:id_motard,:marque,:modele)');
				$req->execute(array(
				'immat'=> $immatriculation,
				'id_motard'=> $id_motard,  // qui correspond � l'id du motard connect�
				'marque'=> $marque,
				'annee'=> $annee,
				'modele'=> $modele		
								
				));
				echo "Moto ajoutée avec succées";
				}
			}

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

		function ReserverSession() {

			$IdSession = $_GET['IdSession'];
			$reqSession = parent::$connexion->prepare('select * from session where id_session = '.$IdSession);
			$reqSession->execute();

			$res = array(//Initialisation du tableau 
				"nb_participant" => array(),
				"nb_place" => array()
			);

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['nb_participant'];
				$res[$i][1] = $donne['nb_place'];		
				$i ++;
			}

			//Vérifie qu'il reste des places 
			if($res[0][0]>=$res[0][1]) {
				return 0;
			}else {
				echo $IdSession;
				$reqIcremente = parent::$connexion->query('update session set nb_participant = '.$res[0][0].' + 1 where id_session = '.$IdSession); 
				// $reqIcremente->execute();
				return 1;
			} 
			
			
		}
	}
?>