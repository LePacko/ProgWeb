<?php 
	

	class Vue_Gerant {

		function __construct() {
			
		}


		function formulaireGerant () {
			echo '';
		}	
		function Circuit($tableauCircuit) {
			
			if(count($tableauCircuit)==6){
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
		
		function InfoSession($info){
			$tab = $info[0];
			echo'date de la session: '.$tab[0].'<br>';
			echo 'nombre de place: '.$tab[1].'<br>';
			echo 'tarif: '.$tab[2].'<br>';
			echo 'status: '.$tab[3].'<br>';
			echo 'nombre de participant: '.$tab[4].'<br>';
			echo 'heure de debut: '.$tab[5].'<br>';
			echo 'heure de fin: '.$tab[6].'<br>';
			echo 'nom du circuit: '.$tab[7].'<br>';
			FonctionsUtiles::RetourPagePrecedente();

		}

		function InfoCircuit($info){
			$tab = $info[0];
			echo'nom du circuit : '.$tab[0].'<br>';
			echo 'adresse : '.$tab[1].'<br>';
			echo 'code postale : '.$tab[2].'<br>';
			echo 'longueur : '.$tab[3].'<br>';
			FonctionsUtiles::RetourPagePrecedente();
		}
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
	}
		
?>