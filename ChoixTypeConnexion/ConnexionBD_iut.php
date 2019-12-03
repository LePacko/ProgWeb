<?php
define('DNS', "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201661");
class ConnexionBD_iut {
	protected static $connexion;

	protected static function init(){
	
		 $user ="dutinfopw201661";
       $password="pyvyparu";
		try{
			self::$connexion = new PDO(DNS, $user, $password);
			
		
		}catch (PDOException $e) {
    		print "Erreur !: " . $e->getMessage() . "<br/>";
    		die();
		}
	}
}
?>