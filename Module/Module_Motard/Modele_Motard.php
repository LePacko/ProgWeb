<?php 
	
include_once("./Connexion.php");

include_once("./FonctionsUtiles.php");
	class Modele_Motard extends Connexion {

		function __construct() {
			parent::init();
			
		}

		public function recupererMarqueMoto() {
			$requete = "SELECT DISTINCT marque from modele_moto";
			$resultat = parent::$connexion->query($requete);
			


			return $resultat;
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
				"siret" => array(),
				"id_circuit"=> array()
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

		function SessionReserver() {

			$id = $_SESSION['session_motard'];
			

			$req = parent::$connexion->prepare('select temps_tour, nom, date from reserver natural join session natural join circuit WHERE id_motard = '.$id.' and temps_tour = 0');
			$req->execute();

			$res = array(
				"session" => array(),
				"tempTour"=> array(),
				"nomCircuit"=> array()
			);

			$i=0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['nom'];
				$res[$i][1] = $donne['date'];	
				$res[$i][2] = $donne['temps_tour'];			
				$i ++;
			}


			$req->closeCursor();

			return $res;
			

		}

		function SessionEffectuer() {

			$id = $_SESSION['session_motard'];
			
			$req = parent::$connexion->prepare('select temps_tour, nom, date from reserver natural join session natural join circuit WHERE id_motard = '.$id.' and temps_tour != 0');
			$req->execute();

			$res = array(
				"session" => array(),
				"tempTour"=> array(),
				"nomCircuit"=> array()
			);

			$i=0;
			while ($donne = $req->fetch()) {

				$res[$i][0] = $donne['nom'];
				$res[$i][1] = $donne['date'];	
				$res[$i][2] = $donne['temps_tour'];			
				$i ++;
			}


			$req->closeCursor();

			return $res;
			
		}

		function recupererMoto() {
			$id_motard=$_SESSION['session_motard'];
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

			if(count($tab)<3) { // le nombre maximum de moto a �t� fix� a 3 mais peut evoluer.

				//R�cup�ration des vaiables entr�e dans le formulaire 
				$immatriculation = $_POST['Immat'];
				$annee = (int)$_POST['Annee'];	
				$marque = $_POST['Marque'];
				$modele= $_POST['Modele'];
				$id_motard=(int)$_SESSION['session_motard'];
			
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
					//Ajout de la nouvelle moto dans le abase de don�es
					$req = parent::$connexion->prepare('INSERT INTO moto (immatriculation,annee,id_motard,marque,modele) values (:immat,:annee,:id_motard,:marque,:modele)');
					$req->execute(array(
					'immat'=> $immatriculation,
					'id_motard'=> $id_motard,  // qui correspond � l'id du motard connect�
					'marque'=> $marque,
					'annee'=> $annee,
					'modele'=> $modele		
								
					));
					FonctionsUtiles::redirectionFormulaireAjoutMoto();
					FonctionsUtiles::msgBox("La moto a ete ajoutee avec succes");
					
					}
				}
			}

			else{
			FonctionsUtiles::msgBox("vous avez atteint le nombre maximum de moto");
			FonctionsUtiles::redirectionPage("index.php?module=Motard&action=mesMotos");
			}

		}

		function Circuit() {

			//Recup�ration des informations concernant le circuit
			$IdCircuit = $_GET['IdCircuit'];
			

			//Recup�ration date et heure actuel 
			$annee = date("Y");
			$mois = date("m");
			$jour = date ("d");
			$date_actuel = date("Y-m-d");
			
			$heure = date("G");
			$minute = date("i");

			  
			$res = array(//Initialisation du tableau 
				"date" => array(),
				"heure_debut" => array(),
				"heure_fin" => array(),
				"nb_place" => array()
			);

			//Recuperation des sessions a venir et insertion dans le tableau res sur ce circuit pas le meme jour 
			$req1 = 'select date, heure_debut, heure_fin, nb_place from session where date > '.'"'.$date_actuel.'"
			and id_circuit= '.$IdCircuit;
			$reqSession = parent::$connexion->prepare($req1);
			$reqSession->execute();

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['date'];
				$res[$i][1] = $donne['heure_debut'];
				$res[$i][2] = $donne['heure_fin'];
				$res[$i][3] = $donne['nb_place'];		
				$i ++;
			}

			//Recuperation des sessions a venir et insertion dans le tableau res sur ce circuit le meme jopur mais plus tard 
			$req2 = 'select  date, heure_debut, heure_fin, nb_place from session where date = '.'"'.$date_actuel.'"
			and id_circuit = '.$IdCircuit.' and heure_debut >'.$heure;
			$reqSession = parent::$connexion->prepare($req2);
			$reqSession->execute();

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['date'];
				$res[$i][1] = $donne['heure_debut'];
				$res[$i][2] = $donne['heure_fin'];
				$res[$i][3] = $donne['nb_place'];
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
				"nb_place" => array(),
				"date" => array(),
                "heure_debut" => array(),
                "heure_fin" => array()
			);

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][0] = $donne['nb_participant'];
				$res[$i][1] = $donne['nb_place'];
				$res[$i][2] = $donne['date'];
                $res[$i][3] = $donne['heure_debut'];
                $res[$i][4] = $donne['heure_fin']; 
						
				$i ++;
			}

			$reqSessionMotard = parent::$connexion->prepare('select date,heure_debut,heure_fin from session natural join reserver where id_motard =' .$_SESSION['session_motard']);
            $reqSessionMotard->execute();

            $resSessionMotard = array( 
                "date" => array(),
                "heure_debut" => array(),
                "heure_fin" => array()
            );

            $i=0;
            while ($donne = $reqSessionMotard->fetch()) {

                $resSessionMotard[$i][0] = $donne['date'];
                $resSessionMotard[$i][1] = $donne['heure_debut'];
                $resSessionMotard[$i][2] = $donne['heure_fin']; 
                
                // echo $resSessionMotard[$i][0].'<br>';
                

                if (strcmp($resSessionMotard[$i][0],$res[0][2])==0) {
                    return 2;
                }
                
                $i ++;
                
            }


			//Vérifie qu'il reste des places 
			if($res[0][0]>=$res[0][1]) {
				return 0;
			}else {
				echo $IdSession;
				$reqIcremente = parent::$connexion->query('update session set nb_participant = '.$res[0][0].' + 1 where id_session = '.$IdSession); 
				$reqReserve = parent::$connexion->query('insert into reserver (id_session,id_motard) values ('.$IdSession.','.$_SESSION['session_motard'].')');
				return 1;
			} 
			
			
		}

		function Avis($tableauCircuit) {

			$IdCircuit = $tableauCircuit[$_GET['tour']][6];
			$reqSession = parent::$connexion->prepare('select note, commentaire, id_circuit, nom,prenom from avis natural join motard where id_circuit='.$IdCircuit);
			$reqSession->execute();

			$res = array(//Initialisation du tableau 
				"note" => array(),
				"commentaire" => array(),
				"id_circuit" => array(),
                "Nom Motard" => array(),
				"Prenom Motard"=>array()
			);

			$i=0;
			while ($donne = $reqSession->fetch()) {

				$res[$i][3] = $donne['prenom'];
				$res[$i][4] = $donne['nom'];
				$res[$i][2] = $donne['id_circuit'];
				$res[$i][0] = $donne['note'];
				$res[$i][1] = $donne['commentaire'];
				$i ++;
			}

			return $res; 

		}
		
		function EnvoyerAvis() {

			$note = $_POST['note'];
			$commentaire = $_POST['commentaire'];
			$id_motard = $_SESSION['session_motard'];
			$tour = $_GET['tour'];
			
			$req= parent::$connexion->prepare('select id_circuit from circuit limit '.$tour.',1');
			$req -> execute();
			$donne= $req->fetch();
			$id_circuit = $donne['id_circuit'];
			
			$reqEnvoyerAvis= parent::$connexion->query('insert into avis (note,commentaire,id_motard,id_circuit) values ("'.$note.'","'.$commentaire.'","'.$id_motard.'","'.$id_circuit.'")');
			
			

		}
	}
?>