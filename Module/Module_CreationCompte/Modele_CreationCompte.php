<?php 
	
	include_once("./Connexion.php"); 
	include_once("./FonctionsUtiles.php"); 

	class Modele_CreationCompte extends Connexion   {

		function __construct() {
			parent::init(); // connexion à la base de donnée 
			
		}

		function AjoutUtilisateurBaseDeDonnées() {

			//Récupération des vaiables entrée dans le formulaire 
			$prenom = htmlspecialchars($_POST['Prenom']);
			$nom = htmlspecialchars($_POST['Nom']);
			$mail = htmlspecialchars($_POST['Mail']);
			$mdp = hash('sha256', htmlspecialchars($_POST['MotDePasse']));			
			
			$adresse = htmlspecialchars($_POST['Adresse']);
			$codepostal = htmlspecialchars($_POST['CodePostal']);
			$numerotel = htmlspecialchars($_POST['NumeroTel']);
			$permis = htmlspecialchars($_POST['Permis']);
				
			//Ajout du nouvelle utilisateur dans le abase de donées
			$req = parent::$connexion->prepare('INSERT INTO motard (nom,Prenom,adresse,code_postal,mail,numero_de_tel,permis,mdp) values (:nom,:prenom,:adresse,:code_postal,:mail,:numero_de_tel,:permis,:mdp)');
			$req->execute(array(
				'prenom' => $prenom,
				'nom' => $nom,
				'adresse' => $adresse,
				'code_postal' =>$codepostal,
				'mail' => $mail,
				'numero_de_tel' => $numerotel,
				'permis' => $permis,
				'mdp' => $mdp
			));
		}

		function AjoutGerantBaseDeDonnées() {
			//Récupération des vaiables entrée dans le formulaire 
			$denomination = htmlspecialchars($_POST['Denomination']);
			$mail = htmlspecialchars($_POST['Mail']);		
			$mdp = hash('sha256', htmlspecialchars($_POST['MotDePasse']));
			$siret = htmlspecialchars($_POST['Siret']);
			$adresse = htmlspecialchars($_POST['Adresse']);
			$codepostal = htmlspecialchars($_POST['CodePostal']);
			$numerotel = htmlspecialchars($_POST['NumeroTel']);
			$date_d_affiliation= date('Y-m-d');

			// on teste si le numero siret est disponible
				$sql = 'SELECT * from entreprise where SIRET like :siret';
				$req2 = parent::$connexion -> prepare($sql);
				$req2 -> bindParam(':siret', $siret);
				$req2 -> execute();
				$testSiret = $req2-> fetch();

				if(isset($testSiret[0])){
					FonctionsUtiles::msgBox("Le numero siret renseignee est deja utilise par un autre gerant");
					FonctionsUtiles::redirectionPage("index.php?module=CreationCompte&action=inscriptionGerant");
				}

				else {
					//Ajout du nouvelle utilisateur dans le abase de donées
					$req = parent::$connexion->prepare('INSERT INTO entreprise (SIRET,denomination,adresse,code_postal,numero_tel,date_d_affiliation,mdp,mail_entreprise) values (:siret,:denomination,:adresse,:codepostale,:numerotel,:date_d_affiliation,:mdp,:mail)');
					$result=$req->execute(array(
						'siret'=> $siret,
						'denomination'=> $denomination,
						'adresse'=> $adresse,
						'codepostale'=> $codepostal,
						'numerotel'=> $numerotel,	
						'date_d_affiliation'=>$date_d_affiliation,			
						'mdp'=> $mdp,
						'mail'=> $mail								
					));
			
					
					
					if (!$result) {
					print_r($req->errorInfo());
					FonctionsUtiles::msgBox("Inscription non valide");
					FonctionsUtiles::redirectionPage("index.php?module=CreationCompte&action=inscriptionGerant");
					} 
					else { 
						FonctionsUtiles::msgBox("Inscription ok!");
					
					}
				}
		}

			

		

	}


?>