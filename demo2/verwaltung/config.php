 <?php
 



 // URL zum Verzeichnis in dem die PHP-Dateien und Unterordner abgelegt wurden:
 $url_termin = "https://service.bbs1-mainz.de/anmldung/"; // BITTE mit / abschließen!
 
//Schuljahr der aktuellen Planung: 

	//$schuljahr = $_SESSION['schuljahr'];
	$erster_tag = "05.09.2022";
	$letzter_tag = "21.07.2023";


//Schuldaten
$schule_name_zeile1 = "Berufsbildende Schule 1";
$schule_name_zeile2 = "- Gewerbe und Technik -";

$schule_strasse_nr = "Am Judensand 12";
$schule_plz_ort = "55122 Mainz";

$schule_tel = "06131-90603-0";
$schule_fax = "06131-90603-99";

$schule_mail = "sekretariat@bbs1-mainz.de";
$schule_url = "https://www.bbs1-mainz.de";
 
 
 
 $schuljahre = array();
 

 
$schuljahre["22-23"]["jahr"] = "2022-2023";
	$schuljahre["22-23"]["erster_tag"] = "05.09.2022";
	$schuljahre["22-23"]["letzter_tag"] = "21.07.2023";
	$schuljahre["22-23"]["stichtag_statistik"] = "12.10.2022";
	$schuljahre["22-23"]["sichtbar_lk"] = 1;
	
$schuljahre["23-24"]["jahr"] = "2023-2024";
	$schuljahre["23-24"]["erster_tag"] = "04.09.2023";
	$schuljahre["23-24"]["letzter_tag"] = "12.07.2024";
	$schuljahre["23-24"]["stichtag_statistik"] = "13.10.2023";
	$schuljahre["23-24"]["sichtbar_lk"] = 1; //Bei 0 erscheint das SJ für Lehrkräfte nicht im Drop-Down-Menü
	
	

 
// Verbindung zur Datenbank aufbauen.
include "/var/www/verbinden_demo2.php";



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
