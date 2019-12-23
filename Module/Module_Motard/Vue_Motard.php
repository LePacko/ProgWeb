<?php 
	

	class Vue_Motard {

		function __construct() {
			
		}

		function formulaireMotard () {
			echo '';
		}	

		function formulaireAjoutMoto(){
			include("./Html/FormulaireAjoutMotoMotard.html");
		}

		function afficherProfil() {
			echo '<a href="index.php?module=Motard&action=formulaireAjoutMoto">Ajouter une moto</a>';
			echo '<a href="index.php?module=Motard&action=mesMotos">Mes Motos</a>';
		}
		
		function ListeCircuit($tableauCircuit) {
			
			if(count($tableauCircuit)==6){
				echo'Vous n avez pas de circuit <br>';
			}
			else{
			$nbcircuit = 1 + count($tableauCircuit) - count($tableauCircuit[0]) . '<br>';
			
			for ($j = 0; $j<$nbcircuit; $j++) {
				echo '<div class = circuit>';
				$tab = $tableauCircuit[$j];
				for($i = 0; $i<count($tab)-1; $i++) {	
					echo '<p>';
					echo $tab[$i] ;
					echo '</p>';					
				}
				$IdCircuit = $tab[6];
				?>
				<a href="index.php?module=Motard&action=Circuit&IdCircuit=<?php echo $IdCircuit; ?>">Choisir ce circuit</a>
				<?php
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