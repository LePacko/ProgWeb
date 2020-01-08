<?php 
	
	include_once("./FonctionsUtiles.php");
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

		function afficherMesMotos($tableauMotos) {
		
			if ($row=$tableauMotos->fetch()) {
				
				echo '<table class="tab_recup">
				<tr>
					<th>Immatriculation</th>
					<th>Annee</th>
					<th>Marque</th>
					<th>Modele</th>
					<th>Supprimer</th>
				</tr>';

				do {
					 
					$immat= $row[0]; $annee = $row[1]; $id_motard= $row[3]; $marque = $row[4];$modele = $row[5];
					echo "<tr>\n
			   
					<td>$immat</td>
					<td>$annee</td>\n
					<td>$marque</td>\n
					<td>$modele</td>\n

					<td>
					<form method=\"post\" action=\"index.php?module=Motard&action=supprimerMoto\">
					<input type=\"hidden\" name=\"id\" id=\"id\" value=\"".$immat."\">
					<input type=\"image\" src=\"./Html/img/del.png\" width=\"30\" height=\"30\" alt=\"supprimer\" name=\"del_img\">
					</form>
					</td>\n	
			  
					</tr>\n";
				}while($row = $tableauMotos->fetch());
				echo "</table>";
			}

			else { 
			FonctionsUtiles::msgBox("Vous n\' avez pas encore ajoute de motos");
			echo '
				Voulez-vous ajouter une moto ?<br />
				<form method="post" action="index.php?module=Motard&action=formulaireAjoutMoto"> 
				<input type="submit" name="Ajouter" id="Ajouter" value="OUI">
				</form>
				<form method="post" action="index.php?module=Motard&action=voirProfil">
				<input type="submit" name="PasAjouter" id="PasAjouter" value="NON">
				</form>
				'; 
				// si oui on redirige vers le formulaire d'ajout d'une moto sinon on reviens a "mon profil"
			}
					
		}

		function avertissementSupression() {
						// si id a ete poste :
			if(isset($_POST['id']) && $_POST['id']!='')
			{
				echo '
				Voulez-vous vraiment SUPPRIMER cet enregistrement ?<br />
				<form method="post" action="index.php?module=Motard&action=suppressionMotoOk">
				<input type="hidden" name="id" id="id" value="'.$_POST['id'].'">
				<input type="submit" name="Supprimer" id="Supprimer" value="Supprimer">
				</form>
				';
			}
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
		

		function SessionReserver($sessionReserver) {

			if(count($sessionReserver)==2){
				echo'Vous n avez pas Reserver de session <br>';
			}
			else {
				
			$nbsession = count($sessionReserver) - count($sessionReserver[0]) . '<br>';
			
			for ($j = 0; $j<$nbsession; $j++) {
				echo '<div class = sessionReserver>';
				$tab = $sessionReserver[$j];
				foreach($tab as $i => $value) {	
					echo '<p>';
					echo $value ;
					echo '</p>';					
				}
				echo '</div>';
			}

			}
		}

		function Circuit($sessions) {

			if (count($sessions)==2) {
				echo'Il n\' y\'a pas de session disponible sur ce circuit <br>';
			}
			else {
			$nbsession = count($sessions) - count($sessions[0]) . '<br>';
			
				for ($j = 0; $j<$nbsession; $j++) {
					echo '<div class = sessionReserver>';
					$tab = $sessions[$j];
					foreach($tab as $i => $value) {	
						echo '<p>';
						echo $value ;
						echo '</p>';
					}					
				}
				$IdSession = $tab[0];
				?>
				<a href="index.php?module=Motard&action=ReserverSession&IdSession=<?php echo $IdSession; ?>">Reserver cette session</a>
				<?php
				echo '</div>';
			}
		}

		function ReserverSession($placedisponible) {
			
			if ($placedisponible==1){
				echo 'Votre réservation a bien été effectué';
			}
			else {
				echo 'Il est impossible de réserver cette session car elle est complète';
			}

			FonctionsUtiles::RetourPagePrecedente();

		}
	}

		
?>