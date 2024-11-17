 <?php
 



 // URL zum Verzeichnis in dem die PHP-Dateien und Unterordner abgelegt wurden:
 $url_termin = "https://service.bbs1-mainz.de/anmldung/"; // BITTE mit / abschließen!
 

	
	
//Einstellungen:
 $vorbelegen_sorge1 = 1; //Adressdaten von Sorgeberechtigter 1 wird bei Minderjährigen mit deren Adressdaten vorbelegt.


// Verbindung zur Datenbank aufbauen.
include "/var/www/verbinden.php";

include "/var/www/verbinden_temp.php";


//Schulformen aktivieren/deaktivieren:
$bs_aktiv = 1;
$bvj_aktiv = 1;
$bf1_aktiv = 1;
$bf2_aktiv = 1;
$bos1_aktiv = 0;
$bos2_aktiv = 0;
$dbos_aktiv = 1;
$bgy_aktiv = 1;
$fs_aktiv = 1;
$hbf_aktiv = 1;





// FUNKTIONEN:

function umlauteumwandeln($str){
 $tempstr = Array("Ä" => "AE", "Ö" => "OE", "Ü" => "UE", "ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss"); 
 return strtr($str, $tempstr);
 }

function dateivergleich($a,$b) {
	$ah = md5_file($a);
	$bh = md5_file($b);
	
	if ($ah == $bh) {
		return "true";
	} else {
		return "false";
	}	
} //Ende Funktion



	

	
?> 
