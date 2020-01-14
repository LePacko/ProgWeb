<!DOCTYPE html>
		<html>
		<head>
			<title>Creation de compte</title>
			<link rel="stylesheet" type="text/css" href="">
			
		</head>
		<body>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

			<form method="post" action="./index.php?module=Gerant&action=messessions">
			
				<label>date</label>
				<input type="date" name="date"required value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"><br>
				<label>nombre de place</label>
				<input type="number" name="nb_place"required><br>
				<label>tarif</label>
                <input type="number" name="tarif"required> <label>€</label><br>
				<label>heure debut</label>
								<div class='input-group date' id='datetimepicker3'>
									<input type='text' class="form-control" name="heure_debut"required/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker3').datetimepicker({
									format: 'HH:mm'
								});
							});
						</script>   
				<label>heure de fin</label>
								<div class='input-group date' id='datetimepicker'>
									<input type='text' class="form-control" name="heure_fin"required/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker').datetimepicker({
									format: 'HH:mm'
								});
							});
						</script>  
                <label> circuit</label>
				<?php
				$tableauCircuit = $this->Modele->Circuit();
					// Variable qui ajoutera l'attribut selected de la liste déroulante
					$selected = '';
					// Parcours du tableau
					echo '<select name="id_circuit">',"\n";
						$nbcircuit = count($tableauCircuit) - count($tableauCircuit[0]) . '<br>';
						// for($i = 0; $i<	count($tableauCircuit); $i++) {
						// 	echo $tableauCircuit[0][0];
						// }
						for ($j = 0; $j<$nbcircuit; $j++) {
							$tab = $tableauCircuit[$j];
							if($tab[5]==$_SESSION['session_gerant']){
								echo "\t",'<option value="', $tab[6] ,'"', '' ,'>', $tab[0] ,'</option>',"\n";
							}
						}
					echo '</select>',"\n";
					?>

     
                
				<input type="submit" value="Ajout Session">

			</form>

		</body>