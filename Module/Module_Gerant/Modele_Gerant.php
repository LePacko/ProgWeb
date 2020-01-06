<?php 
	
include_once("./Connexion.php");

	class Modele_Gerant extends Connexion {

		function __construct() {
			parent::init();
			
		}
		function AjoutCircuit() {

			//Récupération des vaiables entrée dans le formulaire 
			
			$adresse = $_POST['adresse'];		
			$code_postale = $_POST['code_postale'];
			$longueur = $_POST['longueur'];
			$nom = $_POST['nom'];
			$image_circuit =null;
			$siret=$_SESSION['session_gerant'];
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO circuit (adresse,code_postale,longueur,nom,Siret) values (:adresse,:code_postale,:longueur,:nom,:SIRET)');
			$req->execute(array(
				'adresse' => $adresse,
				'code_postale' => $code_postale,
				'longueur' => $longueur,
				'nom' =>$nom,
				'SIRET' => $siret
			));

			
		}


		function AjoutSession() {

			//Récupération des vaiables entrée dans le formulaire 
			
			$date = $_POST['date'];		
			$nb_place = $_POST['nb_place'];
			$tarif = $_POST['tarif'];
			$status = $_POST['status'];
			$heure_debut =$_POST['heure_debut'];
			$heure_fin=$_POST['heure_fin'];
			$id_circuit=$_POST['id_circuit'];
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO session (date,nb_place,tarif,status,heure_debut,heure_fin,id_circuit) values (:date,:nb_place,:tarif,:status,:heure_debut,:heure_fin,:id_circuit)');
			$req->execute(array(
				'date' => $date,
				'nb_place' => $nb_place,
				'tarif' => $tarif,
				'status' => $status,
				'heure_debut' => $heure_debut,
				'heure_fin' => $heure_fin,
				'id_circuit' =>$id_circuit
			));

		}

		function Circuit() {

			$req = parent::$connexion->query('select * from circuit');
			$res = array (
				"nom"  => array(),
				"adresse" => array(),
				"codePostale" => array(),
				"longeur" => array(),
				"imageCircuit" => array(),
				"siret" => array(),
				"id_circuit"=>array()
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

			return $res;			
		}

		function Session(){

			$req = parent::$connexion->query('select * from session inner join circuit where session.id_circuit=circuit.id_circuit ');
			$res = array (
				"date"  => array(),
				"nb_place" => array(),
				"tarif" => array(),
				"status" => array(),
				"nb_participant" => array(),
				"heure_debut" => array(),
				"heure_fin"  => array(),
				"id_circuit" => array(),
			);

			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['date'];
				$res[$i][1] = $donne['nb_place'];
				$res[$i][2] = $donne['tarif'];
				$res[$i][3] = $donne['status'];
				$res[$i][4] = $donne['nb_participant'];
				$res[$i][5] = $donne['heure_debut'];
				$res[$i][6] = $donne['heure_fin'];
				$res[$i][7] = $donne['id_circuit'];
				$i ++;
			}

			return $res;

		}

		

	}


?>