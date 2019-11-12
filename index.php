<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<a href="index.php?=action=Inscription">Je crée moncompte</a>


	<?php 

		if (isset($GET_['action'])) {
			$action = $GET_['action'];
		}

		switch ($action) {
			case 'inscription':
				
				break;
			
			default:
				# code...
				break;
		}

	?>
</body>
</html>