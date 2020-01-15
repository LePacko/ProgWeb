<?php 
	

	class Vue_Gerant {

		function __construct() {
			
		}


		function formulaireGerant () {
			echo '';
		}	
		//function qui permet d'afficher les circuit
		function Circuit($tableauCircuit) {


			
			if(count($tableauCircuit)==7){
				echo'Vous n avez pas de circuit <br>';
			}
			else{
				$valeurValide=true;
				$nbcircuit = count($tableauCircuit) - count($tableauCircuit[0]) . '<br>';
				
				// for($i = 0; $i<	count($tableauCircuit); $i++) {
				// 	echo $tableauCircuit[0][0];
				// }
				for ($j = 0; $j<$nbcircuit; $j++) {
					$tab = $tableauCircuit[$j];
					if($tab[5]==$_SESSION['session_gerant']){
						$valeurValide=false;
						echo'<a href="./index.php?module=Gerant&action=PageCircuit&idCircuit='.$tab[6].'">';
						foreach($tab as $i => $value) {
								if($i!=5)
									echo $value . ' ';
							
						}
						echo'</a>';
					echo '<br>';
					}
				}
				if($valeurValide){
					echo'Vous n avez pas de circuit <br>';
				}
		}
			echo'<a href="./index.php?module=Gerant&action=formulaireAjoutCircuit"> ajout un circuit</a>';
		}	
//function qui permet d'afficher les sessions
		function Session($tableauSession){
			if(count($tableauSession)==8){
				echo'Vous n avez pas de session <br>';
			}
			else{
				$valeurValide=true;
				$nbsession = count($tableauSession) - count($tableauSession[0]) . '<br>';
				// for($i = 0; $i<	count($tableauCircuit); $i++) {
				// 	echo $tableauCircuit[0][0];
				// }
				for ($j = 0; $j<$nbsession; $j++) {
					$tab = $tableauSession[$j];
						$valeurValide=false;
						echo'<a href="./index.php?module=Gerant&action=PageSession&idSession='.$tab[8].'">';
						foreach($tab as $i => $value) {
							
									echo $value . ' ';

						}
						echo'</a>';
					echo '<br>';
					}
				if($valeurValide){
					echo'Vous n avez pas de Session <br>';
				}
		}
		echo'<a href="./index.php?module=Gerant&action=formajoutSession"> ajout un session</a>';
		}
		//function qui permet d'afficher les informations d'une session en details
		function InfoSession($info,$infoMotard){
			$tab = $info[0];
			if(isset($infoMotard)){
				$tabInfo=$infoMotard[0];
			}
			echo'date de la session: '.$tab[0].'<br>';
			echo 'nombre de place: '.$tab[1].'<br>';
			echo 'tarif: '.$tab[2].'<br>';
			echo 'status: '.$tab[3].'<br>';
			echo 'nombre de participant: '.$tab[4].'<br>';
			echo 'heure de debut: '.$tab[5].'<br>';
			echo 'heure de fin: '.$tab[6].'<br>';
			echo 'nom du circuit: '.$tab[7].'<br>';
			if($tab[0]>date('Y-m-d')){
			echo'<a href="./index.php?module=Gerant&action=modifieSession&idSession='.$_GET['idSession'].'"> modifier </a>';
			}

			echo '<br>';
			if(isset($tabInfo)){
				echo 'nom motard: '.$tabInfo[0].'<br>';
			}

			FonctionsUtiles::RetourPagePrecedente();

		}
//function qui permet d'afficher les information d'un circuit en detail
		function InfoCircuit($info){
			$tab = $info[0];
			echo'nom du circuit : '.$tab[0].'<br>';
			echo 'adresse : '.$tab[1].'<br>';
			echo 'code postale : '.$tab[2].'<br>';
			echo 'longueur : '.$tab[3].'<br>';
			echo'<a href="./index.php?module=Gerant&action=modifieCircuit&idCircuit='.$_GET['idCircuit'].'"> modifier </a>';
			FonctionsUtiles::RetourPagePrecedente();
		}
		//function qui affiche le profil de la personne connecte
		function afficheProfil($info){
			$info=$info[0];

			echo'siret :'.$info[0].'<br>';
			echo'denomination de l entreprise :'.$info[1].'<br>';
			echo'email :'.$info[6].'<br>';
			echo'adresse :'.$info[2].'<br>';
			echo'code_postale :'.$info[3].'<br>';
			echo'numero_tel :'.$info[4].'<br>';
			echo'date_d_affiliation :'.$info[5].'<br>';
			echo'<a href="./index.php?module=Gerant&action=modifieProfil"> modifier </a>';
		}
		//function qui gere le formulaire de modification pour le profil
		function modifieProfil($info){
			$info=$info[0];
			echo'
			<form method="post" action="./index.php?module=Gerant&action=modifieValide">
			
			<label>Denomination</label>
			<input type="text" name="Denomination"required value="'.$info[1].'"><br>
			<label>Mail</label>
			<input type="email" name="Mail"required value="'.$info[6].'"><br>
			<label>Numero de téléphone</label>
			<input type="text" name="NumeroTel"  maxlength="10" minlength="10" required value="'.$info[4].'"><br>
			<label>Adresse</label>
			<input type="text" name="Adresse" required value="'.$info[2].'"><br>
			<label>Code Postal</label>
			<input type="text" name="CodePostal"  maxlength="5" minlength="5" required value="'.$info[3].'"><br>
			
			<input type="submit" value="modifier">

		</form>
			';
		}
				//function qui gere le formulaire de modification pour le circuit

		function modifieCircuit($info){
			$info=$info[0];
			echo'
			<form method="post" action="./index.php?module=Gerant&action=modifieValideCircuit&idCircuit='.$_GET['idCircuit'].'">
			
				<label>nom</label>
				<input type="text" name="nom"required value="'.$info[0].'"><br>
				<label>adresse</label>
				<input type="text" name="adresse"required  value="'.$info[1].'"><br>
				<label>code postale</label>
                <input type="number" maxlength="5" name="code_postale"required  value="'.$info[2].'"><br>
                <label>longueur</label>
                <input type="number" name="longueur"  value="'.$info[3].'"><label>KM</label><br> 

				<input type="submit" value="Modifier Circuit">

			</form>
			';
		}
		//function qui gere le formulaire de modification pour la session

		function modifieSession($info){
			$info=$info[0];
			echo'
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

		<form method="post" action="./index.php?module=Gerant&action=modifieValideSession&idSession='.$_GET['idSession'].'">
		
			<label>date</label>
			<input type="date" name="date"required value="'.$info[0].'" min="'.date('Y-m-d').'"><br>
			<label>nombre de place</label>
			<input type="number" name="nb_place"required value="'.$info[1].'"><br>
			<label>tarif</label>
			<input type="number" name="tarif"required value="'.$info[2].'"> <label>€</label><br>
			<label>heure debut</label>
							<div class=\'input-group date\' id=\'datetimepicker3\'>
								<input type=\'text\' class="form-control" name="heure_debut"required value="'.$info[5].'"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
					<script type="text/javascript">
						$(function () {
							$(\'#datetimepicker3\').datetimepicker({
								format: \'HH:mm\'
							});
						});
					</script>   
			<label>heure de fin</label>
							<div class=\'input-group date\' id=\'datetimepicker\'>
								<input type=\'text\' class="form-control" name="heure_fin"required value="'.$info[6].'"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
					<script type="text/javascript">
						$(function () {
							$(\'#datetimepicker\').datetimepicker({
								format: \'HH:mm\'
							});
						});
					</script>  
			
			<input type="submit" value="modifier Session">

		</form>
			';
		}
	}
		
?>