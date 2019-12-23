<?php 
	
include_once("./Connexion.php");
	class Modele_Motard extends Connexion {

		function __construct() {
			parent::init();
			
		}

		function Circuit() {

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


	}


?>