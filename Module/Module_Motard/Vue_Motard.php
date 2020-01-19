


<?php 
	

	include_once("./FonctionsUtiles.php");
	class Vue_Motard {

		function __construct() {			
		}

		function Acceuil() {

			echo '<div id=sessionacceuil>';
			echo '<h1 id="MessageBienvenue">Bienvenue sur MotoSession</h1>';
			echo '</div';
		}

		function afficherProfil() {
			echo '<a class=menuProfil href="index.php?module=Motard&action=formulaireAjoutMoto">Ajouter une moto</a>';
			echo '<a class=menuProfil href="index.php?module=Motard&action=mesMotos">Mes Motos</a>';
			echo '<a class=menuProfil href="index.php?module=Motard&action=mesInformations">Mes informations</a>';
		}	

		function formulaireAjoutMoto($marqueMoto){
			
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
				echo'<a class="boutonretour" href="index.php?module=Motard&action=mesMotos" > <input type="button" onclick="window.location.href=this.parentNode.href.value" value="Voir mes motos" /></a>';
	
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

		//function qui affiche le profil de la personne connecte
		function afficheMesInformations($info){
			$info=$info[0];
			echo'<div id = "infoProfil">';
			echo'nom : '.$info[0].'<br>';
			echo'prenom : '.$info[1].'<br>';
			echo'adresse : '.$info[2].'<br>';
			echo'code_postal : '.$info[3].'<br>';
			echo'email : '.$info[4].'<br>';		
			echo'numero_tel : '.$info[5].'<br>';
			echo'<div class=lienModifier>';
			echo'<a  href="./index.php?module=Motard&action=formulaireModifierMesInformations"> modifier </a>
			</div>
			</div>';
		}
		//function qui gere le formulaire de modification pour le profil
		function formulaireModifierMesInformations($info){
			$info=$info[0];
			
			echo'<div id = "infoProfil">
			<form method="post" action="./index.php?module=Motard&action=modifierMesInformations">
			
			<label>Nom</label>
			<input type="text" name="Nom"required value="'.$info[0].'"><br>
			<label>Prénom</label>
			<input type="text" name="Prenom"required value="'.$info[1].'"><br>
			<label>Adresse</label>
			<input type="text" name="Adresse"  maxlength="10" minlength="10" required value="'.$info[2].'"><br>
			<label>Code postal</label>
			<input type="text" name="CodePostal" required value="'.$info[3].'"><br>
			<label>Email</label>
			<input type="email" name="Email"  maxlength="5" minlength="5" required value="'.$info[4].'"><br>
			<div class=boutonModifier>
			<input type="submit" value="modifier">
			<div>
		</form>
		</div>	';
		}
				
		function ListeCircuit($tableauCircuit) {

			if(count($tableauCircuit)==6){
				echo'Il n\'existe aucun Circuit <br>';
			}
			else{
			$nbcircuit = 1 + count($tableauCircuit) - count($tableauCircuit[0]);
			}

			?>

			<div class="circuit inlineblock">

				<div class="inlineblock">
					<button id="bouttonprecedent"><</button>
				</div>
				
				<div class="inlineblock circuitcourant"> 
					<h1 id="nomCourant"><?php echo $tableauCircuit[$_GET['tour']][0] ?></h1>
					<p id="adresseCourant"><?php echo "Adresse: ".$tableauCircuit[$_GET['tour']][1] ?></p>
					<p id="tourkmCourant"><?php echo "Longueur du circuit : ".$tableauCircuit[$_GET['tour']][3] ?></p>
				</div>

				<div class="inlineblock">
					<button id="bouttonsuivant">></button>
				</div>

				<div id="lienreserver">
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

			
			if(count($sessionReserver)==3){
				echo'<h2 id="AucuneSessionreserver">Vous n\'avez pas encore réservé de session</h2> ';
			}
			else {


			echo '<h1 id="TitreSessionReserver">Voici vos sessions reservées</h1>';
			$nbavis = count($sessionReserver) - count($sessionReserver[0]);
			echo '<div class="SessionreserverListe scroller">';
			for ($j = 0; $j<$nbavis; $j++) {
				echo '<div class = "avis">';

				echo '<h5>';
				echo $sessionReserver[$j][0].'<i> '.$sessionReserver[$j][1];
				echo '</i></h5>';

				echo '</div>';
			}
			echo '</div>';
			}
		}

		function SessionEffectuer($sessionEffectuer) {

			if(count($sessionEffectuer)==3){
				echo'<h2 id="AucuneSessionEffectuer">Vous n\'avez pas encore effectué de session</h2> ';
			}
			else {


			echo '<h1 id="TitreSessionEffectuer">Voici vos sessions effectuées</h1>';
			$nbavis = count($sessionEffectuer) - count($sessionEffectuer[0]);
			echo '<div class="SessionEffectuerListe scroller">';
			for ($j = 0; $j<$nbavis; $j++) {
				echo '<div class = "avis">';

				echo '<h5>';
				echo $sessionEffectuer[$j][0].'<i> '.$sessionEffectuer[$j][1];
				echo '</i></h5>';

				echo '<h5>Temps au tour: '.$sessionEffectuer[$j][2].' min</h5>';

				echo '</div>';
			}
			echo '</div>';
			}
		}

		function Circuit($sessions) {
			
			echo '<div id="SessionGenerale">';

			if (count($sessions)==5) {
				echo '<h2 id="pasSession">Il n\' y\'a pas de session disponible sur ce circuit</h2> <br>';
				
				echo '<div id="bouttonRetourSession">';		
				FonctionsUtiles::RetourPagePrecedente();
				echo '</div>';
			}

			else {

				
				echo '<h1 id="TitreSessionCircuit">Choissisez votre session</h1>';
				$nbsession = count($sessions) - count($sessions[0]);
				echo '<div class="SessionCircuitListe scroller">';
				for ($j = 0; $j<$nbsession; $j++) {
					echo '<div class = "session">';
					echo '<div class ="infosession"';
					echo '<h5> Le: ';
					echo $sessions[$j][0];
					echo '</h5>';

					echo '<h5> De: ';
					echo $sessions[$j][1].' à: '.$sessions[$j][2];
					echo '</h5>';
					echo '</div>';

					

					echo'
					<div class="ReserverSessionBoutton">
					<a href="index.php?module=Motard&action=ReserverSession&IdSession='.$sessions[$j][4].'">Reserver cette session</a>
					</div>
					';
					
	
					echo '</div>';
				}
				echo '</div>';
				
				
			}

			

			echo '</div>';
		}

		function ReserverSession($placedisponible) {
			
			if ($placedisponible==1){
				echo '<h4 class=messageReservation>Votre réservation a bien été effectué</h4>';
			}

			else if ($placedisponible==2) {
				echo '<h4 class=messageReservation>Vous avez deja réserver une session pour le même jour</h4>';
			}

			else {
				echo '<h4 class=messageReservation>Il est impossible de réserver cette session car elle est complète</h4>';
			}

			echo '<div class="bouttonretourApresReserver">';
			FonctionsUtiles::RetourPagePrecedente();
			echo '</div>';

		}

		function Avis($avis) {

			echo '<div class="avisbox inlineblock">';

			echo '<h1>Donnez nous votre avis ...</h1>';

			if(count($avis)==5){
				echo' Il n\'ya aucun avis pour ce circuit ajouter en un ';
			}
			else {
				
			$nbavis = count($avis) - count($avis[0]);
			echo '<div class="avisliste scroller">';
			for ($j = 0; $j<$nbavis; $j++) {
				echo '<div class = "avis">';

				echo '<h5><i>';
				echo $avis[$j][3].' '.$avis[$j][4];
				echo '</i></h5>';

				echo '<p>';
				echo 'Note: '.$avis[$j][0].'/5 Commentaire: '.$avis[$j][1];
				echo '</p>';

				// echo '<p>';
				// echo $avis[$j][0];
				// echo '</p>';


				echo '</div>';
			}
			echo '</div>';
			
			

			}

			echo '	<div id="avisinput">
						<form action="index.php?module=Motard&action=EnvoyerAvis&tour='.$_GET['tour'].'" method="post">
							<label>Note/5: </label>
							<input type="number" min="1" max="5" id="note" name="note" required/>
							<label>Commentaire: </label>
							<textarea maxlength="30" id="commentaire" name="commentaire"></textarea>
							<button id="envoyerAvis" type="submit">Envoyer mon avis</button>
					</div>
				</div>
			
			';

		}

		function EnvoyerAvis($estenvoyer) {

			echo '<div id="merciAvis"><h2>Merci pour votre Avis</h2></div>';
			echo '<div id="RetourAvis">';
			FonctionsUtiles::RetourPagePrecedente();
			echo'<div>';
		}
	}
	
	
?>

