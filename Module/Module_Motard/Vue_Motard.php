<?php 
	

	class Vue_Motard {

		function __construct() {
			
		}

		function formulaireMotard () {
			echo '';
		}	
		
		function Circuit($tableauCircuit) {
			
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
		
?>