 <?php
// Zugangsdaten zur Datenbank
$DB_HOST = "192.168.50.14"; // Öffentliche IP-Adresse Ihres Webservers im Verwaltungsnetzt (dsa-verwaltung)
$erstes_jahr = 22; 

$DB_NAME = "anmeldung_temp"; // Datenbankname

$DB_BENUTZER = "remote_temp"; // Benutzername
$DB_PASSWORT = "IhrStarkesPasswort"; // Passwort

// Zeichenkodierung UTF-8 bei der Verbindung setzen,
// Infos: https://werner-zenk.de/tipps/schriftzeichen_richtig_darstellen.php
// Und eine PDOException bei einem Fehler auslösen.
$OPTION = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
 // Verbindung zur Datenbank aufbauen
 $db_temp = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME,
  $DB_BENUTZER, $DB_PASSWORT, $OPTION);

}
catch (PDOException $e) {
 // Bei einer fehlerhaften Verbindung eine Nachricht ausgeben
 exit("Verbindung fehlgeschlagen! " . $e->getMessage());
}


/*
	if ($jahr_gew > ($erstes_jahr + 1)) {
		  $db_vj = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME_vj,
		  $DB_BENUTZER, $DB_PASSWORT, $OPTION);
		
		
		try {
	 // Verbindung zur Datenbank aufbauen
			$db_vj = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME_vj,
			$DB_BENUTZER, $DB_PASSWORT, $OPTION);

		}
		catch (PDOException $e2) {
		 // Bei einer fehlerhaften Verbindung eine Nachricht ausgeben
		 exit("Verbindung fehlgeschlagen! " . $e2->getMessage());
		}


}
*/
?> 
