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
						foreach($tab as $i => $value) {
								if($i!=5)
									echo $value . ' ';
							
						}
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
				echo'Vous n avez pas de circuit <br>';
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
						foreach($tab as $i => $value) {
									echo $value . ' ';
						}
					echo '<br>';
					}
				if($valeurValide){
					echo'Vous n avez pas de Session <br>';
				}
		}
		echo'<a href="./index.php?module=Gerant&action=formajoutSession"> ajout un session</a>';
		}
	}
		
?>