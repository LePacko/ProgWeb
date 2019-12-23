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
				echo "Moto ajout�e avec succ�es";
				}
			}

		}
	}
?>