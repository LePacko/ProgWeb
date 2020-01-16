<?php

	
		$marque = $_GET['marque'];
		
		$requete = 'SELECT modele from modele_moto where marque ="'. $marque.'"';
		$connexion = new PDO("mysql:host=localhost;dbname=projet;charset=utf8", "root", "");
		$resultat = $connexion->prepare($requete);
		$resultat->execute();

		$data_list=array();
		$i=0;
        while ($data=$resultat->fetch()){
            $data_list[$i]=$data[0];
            
            $i++;
        }

		echo json_encode($data_list);
		

		
	
?>