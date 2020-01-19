<?php 
	
include_once("./Connexion.php");
include_once("./FonctionsUtiles.php");

	class Modele_Gerant extends Connexion {

		function __construct() {
			parent::init();
			
		}
		//fonction qui recupere les donnes permettant l'affichage de l'accueil.
		function acceuil(){

			$query =  parent::$connexion->query("select * from reserver natural join session natural join motard"); 
			$outils = array(); 
			while ($outil = $query->fetch()) 
			  array_push($outils, array("id_session" => $outil["id_session"], 
										  "nom" => $outil["nom"], 
										  "date" => $outil["date"], 
										"id_motard" => $outil["id_motard"], 
										)); 
			echo(json_encode($outils)); 
		}
				//fonction qui recupere les donnes permettant l'affichage du profil.

		function profil(){
			$req = parent::$connexion->query('select * from entreprise where entreprise.siret='.$_SESSION['session_gerant']);
			$res = array (
				"SIRET"  => array(),
				"denomination" => array(),
				"adresse" => array(),
				"code_postal" => array(),
				"numero_tel" => array(),
				"date_d_affiliation" => array(),
				"mail_entreprise" => array()

			);
			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['SIRET'];
				$res[$i][1] = $donne['denomination'];
				$res[$i][2] = $donne['adresse'];
				$res[$i][3] = $donne['code_postal'];
				$res[$i][4] = $donne['numero_tel'];
				$res[$i][5] = $donne['date_d_affiliation'];
				$res[$i][6] = $donne['mail_entreprise'];
				$i ++;
			}
			return $res;

		}
//fonction qui permet d'ajouter un circuit a la base
		function AjoutCircuit() {

			//Récupération des vaiables entrée dans le formulaire 
			
			$adresse = htmlspecialchars($_POST['adresse']);		
			$code_postal = htmlspecialchars($_POST['code_postal']);
			$longueur = htmlspecialchars($_POST['longueur']);
			$nom = htmlspecialchars($_POST['nom']);
			$image_circuit =null;
			$siret=$_SESSION['session_gerant'];
			$req = parent::$connexion->prepare('INSERT INTO circuit (adresse,code_postal,longueur,nom,Siret) values (:adresse,:code_postal,:longueur,:nom,:SIRET)');
			$req->execute(array(
				'adresse' => $adresse,
				'code_postal' => $code_postal,
				'longueur' => $longueur,
				'nom' =>$nom,
				'SIRET' => $siret
			));

			
		}
//fonction qui permet de verifier si les heure rentre pour la sessions sont valide, ne chevauche pas une autre session ou heure de debut et de fin non inverse
		function sessionValide($date,$heure_debut,$heure_fin,$id_circuit){
			//test si deux sessions ne se chevauche pas avant de continuer
			$req = parent::$connexion->query('select * from session inner join circuit where  circuit.siret='.$_SESSION['session_gerant'].' and session.id_circuit=circuit.id_circuit and '.$id_circuit.'=session.id_circuit');
			$res = array (
				"date"  => array(),
				"heure_debut" => array(),
				"heure_fin"  => array(),
			);
			$heuredeb=strtotime($heure_debut);
			$heurefin=strtotime($heure_fin);
			while ($donne = $req->fetch()) {
				$heuredebbase=strtotime($donne["heure_debut"]);
				$heurefinbase=strtotime($donne["heure_fin"]);

				if($donne["date"]==$date){
					if($heuredeb>$heurefin){
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de debut non valide, superieur a heure de fin");
						return 0 ;
					}

					if($heuredeb>=$heuredebbase &&$heuredeb<$heurefinbase){
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de debut non valide, elle chevauche une autre sessions");
						return 0 ;
						
					}
					if($heurefin>$heuredebbase && $heurefin<$heurefinbase){
						
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de fin non valide, elle chevauche une autre sessions");
						return 0;
					}
					if($heuredeb<$heuredebbase && $heurefin>$heurefinbase){
						
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de fin et de debut non valide, elle chevauche une autre sessions");
						return 0;
					}
				}
			}
			return 1 ;

		}
//fonction qui permet de verifier si les heure rentre pour la sessions a modifie sont valide, ne chevauche pas une autre session ou heure de debut et de fin non inverse

		function sessionValideModifie($date,$heure_debut,$heure_fin,$id_circuit,$id_session){
			//test si deux sessions ne se chevauche pas avant de continuer
			$req = parent::$connexion->query('select * from session inner join circuit where  circuit.siret='.$_SESSION['session_gerant'].' and session.id_circuit=circuit.id_circuit and '.$id_circuit.'=session.id_circuit and id_session!='.$id_session);
			$res = array (
				"date"  => array(),
				"heure_debut" => array(),
				"heure_fin"  => array(),
			);
			$heuredeb=strtotime($heure_debut);
			$heurefin=strtotime($heure_fin);
			while ($donne = $req->fetch()) {
				$heuredebbase=strtotime($donne["heure_debut"]);
				$heurefinbase=strtotime($donne["heure_fin"]);

				if($donne["date"]==$date){

					if($heuredeb>=$heuredebbase &&$heuredeb<$heurefinbase){
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de debut non valide, elle chevauche une autre sessions");
						return 0 ;
						
					}
					if($heurefin>$heuredebbase && $heurefin<$heurefinbase){
						
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de fin non valide, elle chevauche une autre sessions");
						return 0;
					}
					if($heuredeb<$heuredebbase && $heurefin>$heurefinbase){
						
						FonctionsUtiles::redirectionPageDelai("index.php?module=Gerant&action=messessions");
						FonctionsUtiles::msgBox("heure de fin et de debut non valide, elle chevauche une autre sessions");
						return 0;
					}
				}
			}
			return 1 ;

		}
//function qui ajoute une session a la base de donnee
		function AjoutSession() {
			

			//Récupération des vaiables entrée dans le formulaire 
			
			$date = htmlspecialchars($_POST['date']);		
			$nb_place = htmlspecialchars($_POST['nb_place']);
			$tarif = htmlspecialchars($_POST['tarif']);
			$heure_debut =htmlspecialchars($_POST['heure_debut']);
			$heure_fin=htmlspecialchars($_POST['heure_fin']);
			$id_circuit=htmlspecialchars($_POST['id_circuit']);
			$valide=$this->sessionValide($date,$heure_debut,$heure_fin,$id_circuit);
			//Ajout du nouvelle utilisateur dans le abase de donées
			if($valide==1){
			$req = parent::$connexion->prepare('INSERT INTO session (date,nb_place,tarif,heure_debut,heure_fin,id_circuit) values (:date,:nb_place,:tarif,:heure_debut,:heure_fin,:id_circuit)');
			$req->execute(array(
				'date' => $date,
				'nb_place' => $nb_place,
				'tarif' => $tarif,
				'heure_debut' => $heure_debut,
				'heure_fin' => $heure_fin,
				'id_circuit' =>$id_circuit
			));
		}

		}
//fonction qui permet de recuperer toute les information des circuit
		function Circuit() {

			$req = parent::$connexion->query('select * from circuit where circuit.siret='.$_SESSION['session_gerant']);
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
				$res[$i][2] = $donne['code_postal'];
				$res[$i][3] = $donne['longueur'];
				$res[$i][4] = $donne['image_circuit'];
				$res[$i][5] = $donne['SIRET'];
				$res[$i][6] = $donne['id_circuit'];
				
				$i ++;
			}

			return $res;			
		}
//fonction qui permet de recuperer toute les informations des sessions
		function Session(){

			$req = parent::$connexion->query('select * from session inner join circuit where  circuit.siret='.$_SESSION['session_gerant'].' and session.id_circuit=circuit.id_circuit ');
			$res = array (
				"date"  => array(),
				"nb_place" => array(),
				"tarif" => array(),
				"nb_participant" => array(),
				"heure_debut" => array(),
				"heure_fin"  => array(),
				"nom" => array(),
				"id_session"=>array(),
			);

			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['date'];
				$res[$i][1] = $donne['nb_place'];
				$res[$i][2] = $donne['tarif'];
				$res[$i][4] = $donne['nb_participant'];
				$res[$i][5] = $donne['heure_debut'];
				$res[$i][6] = $donne['heure_fin'];
				$res[$i][7] = $donne['nom'];
				$res[$i][8] = $donne['id_session'];
				$i ++;
			}

			return $res;

		}
		//fonction qui permet de recupere toute les info des sessions ajouter au info des circuit lui correspondant
		function recupereSession(){
			$req = parent::$connexion->query('select * from session inner join circuit where  id_session='.$_GET['idSession'].' and session.id_circuit=circuit.id_circuit ');
			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['date'];
				$res[$i][1] = $donne['nb_place'];
				$res[$i][2] = $donne['tarif'];
				
				$res[$i][4] = $donne['nb_participant'];
				$res[$i][5] = $donne['heure_debut'];
				$res[$i][6] = $donne['heure_fin'];
				$res[$i][7] = $donne['nom'];
				$res[$i][8] = $donne['id_session'];
				if($donne['date']<date('Y-m-d')){
					$res[$i][3]="Terminée";
				}
				else{
					$res[$i][3]="a venir";
				}
				$i ++;
			}

			return $res;
		}
		function recupereInfoMotard(){
			$req = parent::$connexion->query('select * from reserver natural join motard where  id_session='.$_GET['idSession'].' ');
			$i =0;
			
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['nom'];
				$res[$i][1] = $donne['prenom'];
				$res[$i][2] = $donne['adresse'];
				
				$res[$i][3] = $donne['code_postal'];
				$res[$i][4] = $donne['mail'];
				$res[$i][5] = $donne['numero_tel'];
				$res[$i][6] = $donne['permis'];
			}
			if(isset($res)){
				return $res;
			}

		}
		//fonction qui recupere les informations necessaire du circuit pour l'affichage
		function recupereCircuit(){
			$req = parent::$connexion->query('select * from circuit where id_circuit='.$_GET['idCircuit']);
			$i =0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['nom'];
				$res[$i][1] = $donne['adresse'];
				$res[$i][2] = $donne['code_postal'];
				$res[$i][3] = $donne['longueur'];
				$res[$i][4] = $donne['id_circuit'];
				$i ++;
			}

			return $res;
		}
		//fonction qui permet de modifie un le profil
		function modifieValide(){
			$Denomination = htmlspecialchars($_POST['Denomination']);		
			$CodePostal = htmlspecialchars($_POST['CodePostal']);
			$Mail = htmlspecialchars($_POST['Mail']);
			$NumeroTel = htmlspecialchars($_POST['NumeroTel']);
			$Adresse = htmlspecialchars($_POST['Adresse']);
			$req = parent::$connexion->prepare('UPDATE entreprise set denomination=:Denomination,adresse=:Adresse,code_postal=:CodePostal,numero_tel=:NumeroTel,mail_entreprise=:Mail  where entreprise.siret='.$_SESSION['session_gerant']);
			$req->execute(array(
				'Adresse' => $Adresse,
				'CodePostal' => $CodePostal,
				'Denomination' => $Denomination,
				'Mail' =>$Mail,
				'NumeroTel' => $NumeroTel
			));
			FonctionsUtiles::redirectionPage("index.php?module=Gerant&action=profil");
		}
//function qui permet de modifie un circuit dans la base
		function modifieValideCircuit(){
			$nom = htmlspecialchars($_POST['nom']);		
			$adresse = htmlspecialchars($_POST['adresse']);
			$code_postal = htmlspecialchars($_POST['code_postal']);
			$longueur = htmlspecialchars($_POST['longueur']);
			$req = parent::$connexion->prepare('UPDATE circuit set nom=:nom,adresse=:adresse,code_postal=:code_postal,longueur=:longueur where id_circuit='.$_GET['idCircuit']);
			$req->execute(array(
				'nom' => $nom,
				'adresse' => $adresse,
				'code_postal' => $code_postal,
				'longueur' => $longueur
			));
			FonctionsUtiles::redirectionPage("index.php?module=Gerant&action=mescircuits");
		}
//function qui permet de modifie une sessions dans la base
		function modifieValideSession(){
			$date = htmlspecialchars($_POST['date']);		
			$nb_place = htmlspecialchars($_POST['nb_place']);
			$tarif = htmlspecialchars($_POST['tarif']);
			$heure_debut = htmlspecialchars($_POST['heure_debut']);
			$heure_fin = htmlspecialchars($_POST['heure_fin']);
			$id_circuit = parent::$connexion->query('select id_circuit from session where id_session='.$_GET['idSession']);
			$id_circuit=$id_circuit->fetch();
			
			$valide=$this->sessionValideModifie($date,$heure_debut,$heure_fin,$id_circuit[0],$_GET['idSession']);
			if($valide==1){
			$req = parent::$connexion->prepare('UPDATE session set date=:date,nb_place=:nb_place,tarif=:tarif,heure_debut=:heure_debut,heure_fin=:heure_fin where id_session='.$_GET['idSession']);
			$req->execute(array(
				'date' => $date,
				'nb_place' => $nb_place,
				'tarif' => $tarif,
				'heure_debut' => $heure_debut,
				'heure_fin' => $heure_fin
			));
			FonctionsUtiles::redirectionPage("index.php?module=Gerant&action=messessions");
			}
		}

	}


?>