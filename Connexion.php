<?php
define('DNS_xamp', "mysql:host=localhost;dbname=projet;charset=utf8");
class ConnexionBD_xamp {
	protected static $connexion;

	protected static function init(){
		 $user ="root";
       $password="";
		try{
			self::$connexion = new PDO(DNS_xamp, $user, $password);

		}catch (PDOException $e) {
    		print "Erreur !: " . $e->getMessage() . "<br/>";
    		die();
		}
	}
}
?>