<?php 
	

	class Vue_Motard {

		function __construct() {
			
		}

		function formulaireMotard () {
			echo '';
		}	
		
		function Circuit($tableauCircuit) {
			
			if(count($tableauCircuit)==6){
				echo'Vous n avez pas de circuit <br>';
			}
			else{
			$nbcircuit = count($tableauCircuit) - count($tableauCircuit[0]) . '<br>';
			
			for ($j = 0; $j<$nbcircuit; $j++) {
				echo '<div class = circuit>';
				$tab = $tableauCircuit[$j];
				foreach($tab as $i => $value) {	
					echo '<p>';
					echo $value ;
					echo '</p>';					
				}
				echo '</div>';
			}
		}
		}

		function SessionEffectuer($sessioneffectuer) {

			if(count($sessioneffectuer)==2){
				echo'Vous n avez pas effectuer de session <br>';
			}
			else{
			$nbsession = count($sessioneffectuer) - count($sessioneffectuer[0]) . '<br>';}
			
			for ($j = 0; $j<$nbsession; $j++) {
				echo '<div class = sessioneffectuer>';
				$tab = $sessioneffectuer[$j];
				foreach($tab as $i => $value) {	
					echo '<p>';
					echo $value ;
					echo '</p>';					
				}
				echo '</div>';
			}
		}
	}
		
?>