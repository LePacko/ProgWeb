


<?php 
	

	include_once("./FonctionsUtiles.php");
	class Vue_Motard {

		function __construct() {			
		}

		function formulaireMotard () {
			echo '';
		}	

		function formulaireAjoutMoto($marqueMoto){
			//include("./Html/FormulaireAjoutMotoMotard.php");
			echo '<form id ="formulaireAjoutMoto" method="post" action="./index.php?module=Motard&action=ajoutMoto">
			
				<label>Immatriculation</label>
				<input type="text" name="Immat"required><br>
				<label>Annee</label>
				<input type="text" name="Annee"required><br>

				<label for="marque">Marque</label>';
				
				//$resultat=$marqueMoto;
				
				echo'<select name="Marque" id="marque">';

				
				while ($donnees = $marqueMoto->fetch()) {				
					echo '<option class="marqueSelectionee" value="'.$donnees[0].'">'.$donnees[0].'</option>';		
				}

				echo '</select><br>';
				?>

				

				<?php
				echo '<label>Modele</label><select name="Modele" id="modele"></select>';
				?>
				
				

				<script>
				$("#marque").on("change", function() {
					var donnee = $(this).val();
					
					$.ajax({ 
						dataType: "json", 
						url: "ajax_recup_ModeleMoto.php?marque="+donnee, 
						data: {
                        marque: donnee},
						method: 'GET',
						success: function(data){ 
					
							console.log(data);
							//alert(data[0]);
							var select = '<label>Modele</label> <select name="Modele" id="modele">';
							for (var i = 0; i < data.length; i++) {
  
								select += '<option class="modeleSelectionee" value="'+data[i]+'">'+data[i]+'</option>';

							}
							select += '</select><br>';
							document.getElementById("modele").innerHTML = select;
						}
					});
				});
				</script>

				<script>
			
					$("#marque").change(); // permet de forcer le onChanhe code au dessus pour remplir le select modeleMoto des le premiere affichage du formulaire
    
				
				</script>
				<?php
		
				echo'<br>';
				echo'<input type="submit" value="Ajouter cette moto"> </form>';
	
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
				<input class="avertissementSupression" type="submit" name="Supprimer" id="Supprimer" value="Supprimer">
				<a class="avertissementSupression" href="index.php?module=Motard&action=mesMotos" > <input type="button" onclick="window.location.href=this.parentNode.href.value" value="Annuler" /></a>

				</form>
				';
			}
		}
				
		function ListeCircuit($tableauCircuit) {

			if(count($tableauCircuit)==6){
				echo'Il n\'existe aucun Circuit <br>';
			}
			else{
			$nbcircuit = 1 + count($tableauCircuit) - count($tableauCircuit[0]);
			}
			
			
			

			?>

			<div class="circuit">

				<div class="inlineblock">
					<button id="bouttonprecedent"><</button>
				</div>
				
				<div class="inlineblock circuitcourant"> 
					<h1 id="nomCourant"><?php echo $tableauCircuit[$_GET['tour']][0] ?></h1>
					<p id="adresseCourant"><?php echo "Adresse: ".$tableauCircuit[$_GET['tour']][1] ?></p>
					<p id="tourkmCourant"><?php echo "Km au tour: ".$tableauCircuit[$_GET['tour']][3] ?></p>
				</div>

				<div class="inlineblock">
					<button id="bouttonsuivant">></button>
				</div>

				<div>
					<a href="index.php?module=Motard&action=Circuit&IdCircuit=<?php echo $tableauCircuit[$_GET['tour']][6] ?>">Voir les sessions pour ce circuit</a>
				</div>
			</div>
			

			<script>
				
				$(document).ready(function(){
					
					

					$('#bouttonsuivant').on('click', function(){
						var nbcircuit = <?php echo $nbcircuit; ?>;
						var tour = <?php echo $_GET['tour'] ?>;
						
						if(tour == nbcircuit-2) 
							toursuivant = 0;
						else toursuivant = tour+1;
						
						document.location.href="index.php?module=Motard&action=trouverSession&tour="+toursuivant;
						elem.style.color = 'black';
					});
			
					$('#bouttonprecedent').on('click', function() {
						
						var nbcircuit = <?php echo $nbcircuit; ?>;
						var tour = <?php echo $_GET['tour'] ?>;
						
						
						if(tour == 0) 
							toursuivant = nbcircuit-2;
						else toursuivant = tour-1;
						
						document.location.href="index.php?module=Motard&action=trouverSession&tour="+toursuivant;

					});
				});
				
    		</script><?php

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
					echo '<div>';
					$tab = $sessions[$j];
					foreach($tab as $i => $value) {	
						echo '<p>';
						echo $value ;
						echo '</p>';
					}	
				$IdSession = $tab[0];
				echo $IdSession;
				?>
				<a href="index.php?module=Motard&action=ReserverSession&IdSession=<?php echo $IdSession ?>">Reserver cette session</a>
				<?php	
				echo '</div>';			
				}
				
				

			}

			
		}

		function ReserverSession($placedisponible) {
			
			if ($placedisponible==1){
				echo 'Votre réservation a bien été effectué';
			}

			else if ($placedisponible==2) {
				echo 'Vous avez deja réserver une session pour le même jour';
			}

			else {
				echo 'Il est impossible de réserver cette session car elle est complète';
			}

			FonctionsUtiles::RetourPagePrecedente();

		}

		function Avis($avis) {

			echo '<div class= avis>';

			if(count($avis)==5){
				echo' Il n\'ya aucun avis pour ce circuit ajouter en un ';
			}
			else {
				
			$nbavis = count($avis) - count($avis[0]);
			
			for ($j = 0; $j<$nbavis; $j++) {
				echo '<div class = avis>';
				$tab = $avis[$j];
				foreach($tab as $i => $value) {	
					
					if($i!=2) {
					echo '<p>';
					echo $value ;
					echo '</p>';}					
				}
				echo '</div>';
			}

			
			

			}

			echo '	<div>
						<form action="index.php?module=Motard&action=EnvoyerAvis&tour='.$_GET['tour'].'" method="post">
							<label>Note/5: </label>
							<input type="number" min="1" max="5" id="note" name="note"/>
							<label>Commentaire: </label>
							<input type="texte" maxlength="30" id="commentaire" name="commentaire"/>
							<button type="submit">Envoyer mon avis</button>
					</div>
				</div>
			
			';

		}

		function EnvoyerAvis($estenvoyer) {

			echo '<h2>Merci pour votre Avis</h2>';
			FonctionsUtiles::RetourPagePrecedente();
		}
	}
	
	
?>

