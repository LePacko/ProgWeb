<?php 
	

	class Vue_Motard {

		function __construct() {
			
		}

		function formulaireMotard () {
			echo '';
		}	
		
		function Circuit($tableauCircuit) {
			
			$nbcircuit = count($tableauCircuit) - count($tableauCircuit[0]) . '<br>';
			// for($i = 0; $i<	count($tableauCircuit); $i++) {
			// 	echo $tableauCircuit[0][0];
			// }
			
			for ($j = 0; $j<$nbcircuit; $j++) {
				$tab = $tableauCircuit[$j];
				foreach($tab as $i => $value) {
					echo $value . ' ';
					
				}
				echo '<br>';
			}
		}
	}
		
?>