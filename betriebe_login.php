<?php

include("./kopf.php");

date_default_timezone_set('Europe/Berlin');



@session_start();

$zufall = $_GET['num'];

include "./config.php";
$select_zuf = $db_temp->query("SELECT * FROM anfrage WHERE zufall = '$zufall'");	
		foreach($select_zuf as $zuf) {
            $zuf_id_betrieb = $zuf['id_betrieb'];
            $_SESSION['mail_anfrage'] = $zuf['mail_anfrage'];
        }

    If ($zuf_id_betrieb != "") {
        $_SESSION['betriebe_user'] = $zuf_id_betrieb;
        
        header("Location: ./betriebe_datenblatt.php");
    } else {
        echo "Bitte erst authentifizieren!";
        header("Location: ./betriebe_anfrage.php");
     
     }
     
     include("./fuss.php");
     
     ?>