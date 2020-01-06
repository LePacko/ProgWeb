<?php 

class FonctionGlobale {

    function TableauTable($table) {

        $req =  parent::$connexion->prepare('select * from '.$table);
        $req->execute();

        $res = array();

        //for ($i = 0; $i<){}





    }





}











?>