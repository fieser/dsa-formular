<?php



include("/var/www/html/anmeldung/demo/verwaltung/kopf.php");

include("./login_inc.php");
@session_start();




	
include("/var/www/html/anmeldung/demo/verwaltung/config.php");



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];


echo "<h1>Abweichungen ermitteln</h1>";

$fehler = 0;

// Tabelle leeren:
				
				
					if ($db->exec("TRUNCATE TABLE `fehler`")) {
		
						

					}

//Anmeldebögen auflisten:
$select_an = $db->query("SELECT DISTINCT dsa_bewerberdaten.*, dsa_bildungsgang.* FROM dsa_bewerberdaten LEFT JOIN dsa_bildungsgang ON dsa_bildungsgang.id_dsa_bewerberdaten = dsa_bewerberdaten.id WHERE status = 'übertragen' OR status = 'reaktivierbar' GROUP BY dsa_bewerberdaten.id ORDER BY schulform, beruf, bgy_sp1 ASC");
$treffer_an = $select_an->rowCount();

	
	foreach ($select_an as $an) {
		
		$geburtsdatum = $an['geburtsdatum'];
		$nachname = $an['nachname'];
		$vorname = $an['vorname'];

		$schueler_vergleich = 1;
		
					//Bewerberdaten durchsuchen:
			
			$select_edoo_b = $db->query("SELECT * FROM edoo_bewerber WHERE geburtsdatum = '$geburtsdatum' AND nachname = '$nachname' AND vorname = '$vorname'");	
			$treffer_edoo_b = $select_edoo_b->rowCount();
			
			foreach($select_edoo_b as $edoo) {
				
				$id_edoo = $edoo['id'];
				$id_bewerberdaten = $an['id_dsa_bewerberdaten'];
				$id_bildungsgang = '';
				

				if (trim($an['vorname']) != trim($edoo['vorname'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['vorname'];
					$feld_dsa = $an['vorname'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Vorname',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				
				if (trim($an['geburtsort']) != trim($edoo['geburtsort'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['geburtsort'];
					$feld_dsa = $an['geburtsort'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Geburtsort',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['geburtsland']) != trim($edoo['geburtsland'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['geburtsland'];
					$feld_dsa = $an['geburtsland'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Geburtsland',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				
				if (trim($an['staatsangehoerigkeit']) != trim($edoo['staatsangehoerigkeit'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['staatsangehoerigkeit'];
					$feld_dsa = $an['staatsangehoerigkeit'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Staatsangehörigkeit',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				
				if (trim($an['herkunftsland']) != trim($edoo['herkunftsland'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['herkunftsland'];
					$feld_dsa = $an['herkunftsland'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'herkunftsland',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				
				if (trim($an['zuzug']) != trim($edoo['zuzugsdatum'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['zuzugsdatum'];
					$feld_dsa = $an['zuzug'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Zuzugsdatum',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['geschlecht']) != trim($edoo['geschlecht'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['geschlecht'];
					$feld_dsa = $an['geschlecht'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Geschlecht',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['religion']) != trim($edoo['religionszugehoerigkeit'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['religionszugehoerigkeit'];
					$feld_dsa = $an['religion'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Religionszugehoerigkeit',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['strasse']) != trim($edoo['strasse'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['strasse'];
					$feld_dsa = $an['strasse'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Straße',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['plz']) != trim($edoo['plz'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['plz'];
					$feld_dsa = $an['plz'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Postleitzahl',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['hausnummer']) != trim($edoo['hausnummer'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['hausnummer'];
					$feld_dsa = $an['hausnummer'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Hausnummer',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				if (trim($an['wohnort']) != trim($edoo['wohnort'])) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['wohnort'];
					$feld_dsa = $an['wohnort'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Wohnort',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
				//if ($an['mail'] != $edoo['mail']) {
				if (strcasecmp (trim($an['mail']), trim($edoo['mail'])) != 0) {
					
					$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
					$feld_edoo = $edoo['mail'];
					$feld_dsa = $an['mail'];

						if ($db->exec("INSERT INTO `fehler`
									   SET
										`id_edoo` = '$id_edoo',
										`id_bewerberdaten` = '$id_bewerberdaten',
										`id_bildungsgang` = '$id_bildungsgang',
										`feld_edoo` = '$feld_edoo',
										`feld_dsa` = '$feld_dsa',
										`feldname` = 'Email-Adresse',
										`hinweis` = '$hinweis',
										`erledigt` = '0'")) {
						}
				$fehler = ($fehler + 1);
				}
				
			}
					
		if ($schueler_vergleich == 1) {
			
			if ($treffer_edoo_b == 0) { //Wenn keine Schülerdaten vorliegen
					
			//Schülerdaten durchsehen:
			$select_edoo_s = $db->query("SELECT * FROM edoo_schueler WHERE geburtsdatum = '$geburtsdatum' AND nachname = '$nachname' AND vorname = '$vorname'");	
			$treffer_edoo_s = $select_edoo_s->rowCount();
			
				foreach($select_edoo_s as $edoo) {
					
					$id_edoo = $edoo['id'];
					$id_bewerberdaten = $an['id_dsa_bewerberdaten'];
					$id_bildungsgang = '';
					

					if (trim($an['vorname']) != trim($edoo['vorname'])) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['vorname'];
						$feld_dsa = $an['vorname'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'Vorname',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					
					if (trim($an['strasse']) != trim($edoo['strasse'])) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['strasse'];
						$feld_dsa = $an['strasse'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'Straße',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					if (trim($an['hausnummer']) != trim($edoo['hausnummer'])) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['hausnummer'];
						$feld_dsa = $an['hausnummer'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'Hausnummer',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					
					if (trim($an['plz']) != trim($edoo['plz'])) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['plz'];
						$feld_dsa = $an['plz'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'PLZ',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					
					if (trim($an['wohnort']) != trim($edoo['wohnort'])) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['wohnort'];
						$feld_dsa = $an['wohnort'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'Wohnort',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					
					//if ($an['mail'] != $edoo['mail']) {
					if (strcasecmp (trim($an['mail']), trim($edoo['mail'])) != 0) {
						
						$hinweis = "Wert in edoo.sys stimmt nicht mit Anmeldeformular überein!";
						$feld_edoo = $edoo['mail'];
						$feld_dsa = $an['mail'];

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '$feld_edoo',
											`feld_dsa` = '$feld_dsa',
											`feldname` = 'E-Mail',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
				//Betrieb zugeornet?
						
			$select_edoo_sb = $db->query("SELECT * FROM edoo_schueler_betrieb WHERE geburtsdatum = '$geburtsdatum' AND nachname = '$nachname' AND vorname = '$vorname'");	
			$treffer_edoo_sb = $select_edoo_sb->rowCount();
					
					if ($an['schulform'] == "bs" AND ($an['betrieb'] != "" OR $an['betrieb'] != "") AND $treffer_edoo_sb == 0) {
						
						$hinweis = "Ausbildungsbetrieb fehlt in edoo.sys!";
						

							if ($db->exec("INSERT INTO `fehler`
										   SET
											`id_edoo` = '$id_edoo',
											`id_bewerberdaten` = '$id_bewerberdaten',
											`id_bildungsgang` = '$id_bildungsgang',
											`feld_edoo` = '',
											`feld_dsa` = '',
											`feldname` = 'Ausbildungsbetrieb',
											`hinweis` = '$hinweis',
											`erledigt` = '0'")) {
							}
					$fehler = ($fehler + 1);
					}
					
					
					
				}
			
		}
		
		
		
		

		}
	
	
	}


if ($fehler == 0) {
echo "Keine Abweichungen zwischen den Bewerberdaten und edoo.sys gefunden. <p style='margin-bottom: 20px;'><b>Es gibts nichts zu tun!</b></p>";
} else {
echo $fehler." Abweichungen in edoo.sys gefunden!";
}

?>

<p>
<form method="post" action="./index.php">
<input type="submit" class='btn btn-default btn-sm' name="cmd[doStandardAuthentication]" value="zurück" />
</form></p>
<?php

	include("/var/www/html/anmeldung/demo/verwaltung/fuss.php");
?>