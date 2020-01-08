<!DOCTYPE html>
		<html>
		<head>
			<title>Ajouter une Moto</title>
			<link rel="stylesheet" type="text/css" href="">

		</head>
		<body>
		
			<form method="post" action="./index.php?module=Motard&action=ajoutMoto">
			
				<label>Immatriculation</label>
				<input type="text" name="Immat"required><br>
				<label>Annee</label>
				<input type="text" name="Annee"required><br>

				<label for="marque">Dans quel pays habitez-vous ?</label><br />
				<select name="marque" id="marque">
				</select>
				<label>Modele</label>
				<input type="text" name="Modele"required><br>
				
				<input type="submit" value="Ajouter cette moto">

			</form>

		</body>
		
</html>