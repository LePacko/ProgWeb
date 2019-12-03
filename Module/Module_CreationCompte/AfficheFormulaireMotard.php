<!DOCTYPE html>
		<html>
		<head>
			<title>Creation de compte</title>
			<link rel="stylesheet" type="text/css" href="">
		</head>
		<body>
		
			<form method="post" action="./index.php?module=CreationCompte&action=ajoutMotardBD">
			
				<label>Nom</label>
				<input type="text" name="Nom"required><br>
				<label>Prenom</label>
				<input type="text" name="Prenom"required><br>
				<label>Mail</label>
				<input type="email" name="Mail"required><br>
				<label>Mot de passe</label>
                <input type="password" name="MotDePasse"required><br>
                <label>Adresse</label>
                <input type="text" name="Adresse"required><br>
                <label>Code Postal</label>
                <input type="text" name="CodePostal"required><br>
                <label>Numero de téléphone></label>
                <input type="text" name="NumeroTel"required><br>
                <label>Permis</label>
                <input type="file" name="Permis"><br>

				<input type="submit" value="Crée mon compte">

			</form>

		</body>
</html>