<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./Html/style/styleApresConnexion.css" type="text/css"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	
</head>
<svg viewBox="0 0 1200 700" xmlns="http://www.w3.org/2000/svg"
  version="1.1" class="svg">
<path d="M0 80 C 100 78, 120 79, 600 115 S 1200 140, 1200 140" stroke="black" fill="transparent" id="courbe"/>
<path d="M0 480 C 100 478, 120 479, 600 515 S 1200 540, 1250 540" stroke="black" fill="transparent" id="courbe"/>
</svg>
<body class="body">

	<div class="container">
		<div class="row">

				<div class="col-lg-12 HautPage">
				<div class="row">

						<div class="col-lg-2 LogoTitre">
						<div class="row">

							<div class="col-lg-12">
							<div class="row">
								<img src="./Html/img/casque.png">
							</div>
							</div>

							<!-- <div class="col-lg-12">
							<div class="row">
								<h1 class="TitreSite">Moto Session</h1>
							</div>
							</div> -->
							
						</div>
						</div>

						<div class="col-lg-10 Nav">
						<div class="row">
						<?php

	                        if(isset($_SESSION['session_motard'])){       // si il s'agit d'un motard qui est connecté 
	                            include ("./Html/NavMotard.html");
	                        }

	                        if(isset($_SESSION['session_gerant'])){      // si il s'agit d'un gérant de circuit
	                            include ("./Html/NavGerant.html");
	                        }
                   		
                		?>

						</div>
						</div>

						
				</div>
				</div>


				<div class="row BasPage">
			

				</div>
		
		</div>	
	</div>	


 
    <section>
        <article> 
            <?= $menu ?>
        </article>
        <article>
            <?= $module ?>
        </article>
    </section>

    <!-- Animation -->

	<script type="text/javascript" src="./Html/AnimationJs/FonduAnimation.js"></script>
	<script type="text/javascript" src="./Html/AnimationJS/TitreAnimation.js"></script>
	
	<script type="text/javascript"> 

		function changecircuit() {

		
		var nom = document.getElementById('2').textContent;
		document.getElementById('circuitcourant').textContent = nom;
		
			
		}

	</script>

</body>
</html>