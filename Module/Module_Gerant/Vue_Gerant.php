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
			echo'<a href="./index.php?module=Gerant&action=formajout"> ajout un circuit</a>';
		}	
	}
		
?>