<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");




$nachname = $_SESSION['nachname'];
	$vorname = $_SESSION['vorname'];
	$geschlecht = $_SESSION['geschlecht'];
	$geburtsdatum = $_SESSION['geburtsdatum'];
	$geburtsort = $_SESSION['geburtsort'];
	$geburtsland = $_SESSION['geburtsland'];
	$zuzug = $_SESSION['zuzug'];
	$staatsangehoerigkeit = $_SESSION['staatsangehoerigkeit'];
	$muttersprache = $_SESSION['muttersprache'];
	$religion = $_SESSION['religion'];
	$herkuftsland = $_SESSION['herkuftsland'];
	$strasse = $_SESSION['strasse'];
	$plz = $_SESSION['plz'];
	$wohnort = $_SESSION['wohnort'];
	$hausnummer = $_SESSION['hausnummer'];
	$telefon1 = $_SESSION['telefon1'];
	$telefon2 = $_SESSION['telefon2'];
	$mail = strtolower($_SESSION['mail']);
	$schulart = $_SESSION['schulart'];
	$schulname = $_SESSION['schulname'];
	$jahrgang = $_SESSION['jahrgang'];
	$abschluss = $_SESSION['abschluss'];
	
	$sorge1_vorname = $_SESSION['sorge1_vorname'];
	$sorge1_nachname = $_SESSION['sorge1_nachname'];
	$sorge1_anrede = $_SESSION['sorge1_anrede'];
	$sorge1_art = $_SESSION['sorge1_art'];
	$sorge1_strasse = $_SESSION['sorge1_strasse'];
	$sorge1_hausnummer = $_SESSION['sorge1_hausnummer'];
	$sorge1_plz = $_SESSION['sorge1_plz'];
	$sorge1_wohnort = $_SESSION['sorge1_wohnort'];
	$sorge1_telefon1 = $_SESSION['sorge1_telefon1'];
	$sorge1_telefon2 = $_SESSION['sorge1_telefon2'];
	$sorge1_mail = $_SESSION['sorge1_mail'];
	
	$sorge2_vorname = $_SESSION['sorge2_vorname'];
	$sorge2_nachname = $_SESSION['sorge2_nachname'];
	$sorge2_anrede = $_SESSION['sorge2_anrede'];
	$sorge2_art = $_SESSION['sorge2_art'];
	$sorge2_strasse = $_SESSION['sorge2_strasse'];
	$sorge2_hausnummer = $_SESSION['sorge2_hausnummer'];
	$sorge2_plz = $_SESSION['sorge2_plz'];
	$sorge2_wohnort = $_SESSION['sorge2_wohnort'];
	$sorge2_telefon1 = $_SESSION['sorge2_telefon1'];
	$sorge2_telefon2 = $_SESSION['sorge2_telefon2'];
	$sorge2_mail = $_SESSION['sorge2_mail'];
	
	$schulform = $_SESSION['schulform'];
	$prio_akt = $_SESSION['prio_akt'];
	$dauer = $_SESSION['dauer'];
	$beginn = $_SESSION['beginn'];
	$ende = $_SESSION['ende'];
	$beruf = $_SESSION['beruf'];
	$beruf_anz = $_SESSION['beruf_anz'];
	$beruf2 = $_SESSION['beruf2'];
	$betrieb = $_SESSION['betrieb'];
	$betrieb2 = $_SESSION['betrieb2'];
	$betrieb_plz = $_SESSION['betrieb_plz'];
	$betrieb_ort = $_SESSION['betrieb_ort'];
	$betrieb_strasse = $_SESSION['betrieb_strasse'];
	$betrieb_hausnummer = $_SESSION['betrieb_hausnummer'];
	$betrieb_telefon = $_SESSION['betrieb_telefon'];
	$betrieb_mail = $_SESSION['betrieb_mail'];
	$ausbilder_nachname = $_SESSION['ausbilder_nachname'];
	$ausbilder_vorname = $_SESSION['ausbilder_vorname'];
	$ausbilder_telefon = $_SESSION['ausbilder_telefon'];
	$ausbilder_telefon2 = $_SESSION['ausbilder_telefon2'];
	$ausbilder_mail = $_SESSION['ausbilder_mail'];
	
	$bgy_sp1 = $_SESSION['bgy_sp1'];
	$bgy_sp2 = $_SESSION['bgy_sp2'];
	$bgy_sp3 = $_SESSION['bgy_sp3'];
	
	$fs1 = $_SESSION['fs1'];
	$fs1_von = $_SESSION['fs1_von'];
	$fs1_bis = $_SESSION['fs1_bis'];
	
	$fs2 = $_SESSION['fs2'];
	$fs2_von = $_SESSION['fs2_von'];
	$fs2_bis = $_SESSION['fs2_bis'];
	
	$fs3 = $_SESSION['fs3'];
	$fs3_von = $_SESSION['fs3_von'];
	$fs3_bis = $_SESSION['fs3_bis'];
	

	
	
	//md5-summe für spätere Identifizierung bilden:
	$summe = md5($mail.$geburtsdatum.$schulform);
	
	//md5-summe ohne Schulform bildenn:
	$summe_o_sf = md5($mail.$geburtsdatum);
	
	//Uploadlink erstellen:
	$_SESSION['link_upload'] = "https://anmeldung.bbs1-mainz.de/upload.php?id=".$summe_o_sf."&id2=".$_SESSION['plz'];
	
	
		/*		
	echo "<pre>";
	print_r ( $_POST );
	echo "</pre>";
	*/
	
	//Dateiupload:
	
	if (isset($_POST['upload_submit'])) {
	
			function encryptFile($sourceFile, $destFile, $passphrase) {
			$key = openssl_digest($passphrase, 'SHA256', TRUE);
			$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

			$fileContent = file_get_contents($sourceFile);
			$encrypted = openssl_encrypt($fileContent, 'aes-256-cbc', $key, 0, $iv);

			// IV an den Anfang des verschlüsselten Inhalts hängen
			$result = file_put_contents($destFile, $iv . $encrypted);
			return $result !== false;
		}

		if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['uploaded_file'])) {
			// Prüfen, ob eine Datei ausgewählt wurde und ob der Upload erfolgreich war
    if ($_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
			$uploadDir = 'dokumente/';
			$uploadedFile = $_FILES['uploaded_file']['tmp_name'];
			
			$fileType = mime_content_type($uploadedFile);
			//$destFile = $uploadDir . $_FILES['uploaded_file']['name'] . '.enc';
			
			// Überprüfen, ob die Datei eine PDF-Datei ist
			if ($fileType != 'application/pdf') {
				echo "<p>&nbsp;</p>";
				echo "<b>Bitte laden Sie nur PDF-Dateien hoch!</b>";
				echo "<p>&nbsp;</p>";
								echo "<form id='form_w' method='post' action='https://anmeldung.bbs1-mainz.de/upload.php'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_w' type='submit' name='submit_zurueck' value='zurück'>";
								echo "</form>";
				exit;
			}
			
			$destFile = $uploadDir.$summe_o_sf.'.'.time().'.pdf.enc';
			$fileName = $summe_o_sf.'.'.time().'.pdf.enc';

			// Stellen Sie sicher, dass das Verzeichnis existiert
			if (!file_exists($uploadDir)) {
				mkdir($uploadDir, 0777, true);
			}
			
			
			    // Dateinamen anpassen, um Überschreibungen zu vermeiden
				$newFilePath = $uploadDir . $fileName;
				$fileCounter = 1;
				$fileExtension = "pdf.enc";

				while (file_exists($newFilePath)) {
					// Dateinamen um eine Ziffer erhöhen
					$newFileName = pathinfo($fileName, PATHINFO_FILENAME) . "_" . $fileCounter . '.' . $fileExtension;
					$newFilePath  = $uploadDir . $newFileName;
					$fileCounter++;
				}
			//$summe_o_sf = md5($mail.$geburtsdatum);
			$password = md5(md5($mail.$geburtsdatum).$_SESSION['plz']);  // Dies sollte in einer sicheren Konfigurationsdatei gespeichert werden

			if (encryptFile($uploadedFile, $newFilePath, $password)) {
				echo "<h2><b><font color='green'>Datei erfolgreich hochgeladen und verschlüsselt.</font></b></h2>";
				if ($fileCounter == 1) {
			//		echo "<p>Insgesamt haben Sie heute 1 Datei hochgeladen.</p>";
				} else {
			//		echo "<p>Insgesamt haben Sie heute ".$fileCounter." Dateien hochgeladen.</p>";
				}
				
				//Zip-Archiv erstellen:
				$sourceDir = 'dokumente/'; // Verzeichnis, in dem sich die .enc Dateien befinden
				$zipFile = $sourceDir . 'dokumente.zip'; // Pfad zur ZIP-Datei

				// Erstellen eines neuen ZIP-Archivs
				$zip = new ZipArchive();

				// ZIP-Datei öffnen und überschreiben, wenn sie bereits existiert
				if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
					exit("<h2><b><font color='red'>Konnte ZIP-Datei nicht öffnen oder erstellen.</font></b></h2>");
				}

				// Dateien im Verzeichnis auflisten
				$files = new DirectoryIterator($sourceDir);
				foreach ($files as $file) {
					if ($file->isFile() && $file->getExtension() === 'enc') {
						// Datei zum ZIP-Archiv hinzufügen
						$zip->addFile($file->getPathname(), $file->getFilename());
					}
				}

				// ZIP-Archiv abschließen und schließen
				$zip->close();

				//echo "ZIP-Archiv wurde erfolgreich erstellt: $zipFile";
				
				
				 
				
				 
			} else {
				echo "Fehler bei der Verschlüsselung der Datei.";
			}
		} else if ($_FILES['uploaded_file']['error'] === UPLOAD_ERR_NO_FILE) {
        // Keine Datei wurde hochgeladen
        echo "<h2><b><font color='red'>Bitte wählen Sie eine Datei zum Hochladen aus!</font></b></h2>";
    } else {
        // Andere Fehler beim Hochladen
        echo "<h2><b><font color='red'>Fehler beim Hochladen der Datei. Bitte versuchen Sie es erneut.</font></b></h2>";
    }
		} else {
			if (isset($_POST['upload_submit'])) {
				echo "<p><b><font color='red'>Keine Datei zum Hochladen erhalten.</font></b></p>";
			}
		}
	
								//Buttons:
								
								echo "<p><b>Nutzen Sie folgenden Link, um jetzt oder später weitere Dokumente zu Ihrer Anmeldung hochzuladen.</b></p>";
								echo "<b><a href='https://anmeldung.bbs1-mainz.de/upload.php?id=".$summe_o_sf."&id2=".$_SESSION['plz']."'>https://anmeldung.bbs1-mainz.de/upload.php?id=".$summe_o_sf."&id2=".$_SESSION['plz']."</a></b><br>";
								echo "<div style='margin-top: 1em;'><small>(Um diesen Link später nutzen zu können, müssen Sie ihn jetzt speichern oder notieren.)</small></div>";
								echo "<p>&nbsp;</p>";
								echo "<form id='form_n' method='post' action='./index.php'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_n' type='submit' name='submit_neu' value='weitere Anmeldung erstellen'>";
								echo "</form>";
								echo "<p>&nbsp;</p>";
								echo "<form id='form_w' method='post' action='https://www.bbs1-mainz.com'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_w' type='submit' name='submit_website' value='zu unserer Website'>";
								echo "</form>";
		
		
	} else {
	
	//Prioritäten prüfen:
	if (isset($_POST['prio_1']) AND $_POST['prio_1'] != "") {
	$prio_1 = $_POST['prio_1'];
	}
	if (isset($_POST['prio_2']) AND $_POST['prio_2'] != "") {
	$prio_2 = $_POST['prio_2'];
	}
	if (isset($_POST['prio_3']) AND $_POST['prio_3'] != "") {
	$prio_3 = $_POST['prio_3'];
	}
	if (isset($_POST['prio_4']) AND $_POST['prio_4'] != "") {
	$prio_4 = $_POST['prio_4'];
	}
	if (isset($_POST['prio_5']) AND $_POST['prio_5'] != "") {
	$prio_5 = $_POST['prio_5'];
	}

if (isset($_POST['submit_weiter']) AND $_POST['dsgvo'] == 1) {

//Vollständigkeit der Eingaben prüfen:
if ($schulform != "" AND $nachname != "" AND $geburtsdatum != "" AND ($schulform != "bs" OR ($schulform == "bs" AND $beruf != "" AND $betrieb != ""))) {
	
//Prioritäten zuordnen:

//$select_an = $db_temp->query("SELECT DISTINCT dsa_bewerberdaten.*, dsa_bildungsgang.* FROM dsa_bewerberdaten LEFT JOIN dsa_bildungsgang ON dsa_bildungsgang.id_dsa_bewerberdaten = dsa_bewerberdaten.id WHERE nachname LIKE '%$nachname%' AND vorname LIKE '%$vorname%' AND geburtsdatum = '$geburtsdatum' GROUP BY dsa_bewerberdaten.id");
$select_an = $db_temp->query("SELECT * FROM summen WHERE md5_o_sf LIKE '$summe_o_sf'");
		
	
	$treffer_an = $select_an->rowCount();
	
	foreach($select_an as $an) {
		$id = $an['id'];
		
	/*		
	echo "<pre>";
	print_r ( $an );
	echo "</pre>";
	*/
		
		if ($_POST['prio_1'] == $an['schulform']) {
			
									// Datensatz aendern.	
			if ($db_temp->exec("UPDATE `summen`
						   SET
							`prio` = '1' WHERE `id` = '$id'")) {
			}
		}
		
		if ($_POST['prio_2'] == $an['schulform']) {
			
									// Datensatz aendern.	
			if ($db_temp->exec("UPDATE `summen`
						   SET
							`prio` = '2' WHERE `id` = '$id'")) {
			}
		}
		
		if ($_POST['prio_3'] == $an['schulform']) {
			
									// Datensatz aendern.	
			if ($db_temp->exec("UPDATE `summen`
						   SET
							`prio` = '3' WHERE `id` = '$id'")) {
			}
		}
		
		if ($_POST['prio_4'] == $an['schulform']) {
			
									// Datensatz aendern.	
			if ($db_temp->exec("UPDATE `summen`
						   SET
							`prio` = '4' WHERE `id` = '$id'")) {
			}
		}
		
		if ($_POST['prio_5'] == $an['schulform']) {
			
									// Datensatz aendern.	
			if ($db_temp->exec("UPDATE `summen`
						   SET
							`prio` = '5' WHERE `id_dsa_bewerberdaten` = '$id'")) {
			}
		}
	}
		//Priorität für aktuelle Anmeldung setzen:
		if ($_POST['prio_1'] == $schulform) {
			$prio_akt = 1;
		}
		if ($_POST['prio_2'] == $schulform) {
			$prio_akt = 2;
		}
		if ($_POST['prio_3'] == $schulform) {
			$prio_akt = 3;
		}
		if ($_POST['prio_4'] == $schulform) {
			$prio_akt = 4;
		}
		if ($_POST['prio_5'] == $schulform) {
			$prio_akt = 5;
		}


	
	//Zufallszahl generieren:
	$code = mt_rand(10000000, 99999999);
	
	$time = time();
	
	
	
	//Daten schreiben
	
	if ($db_temp->exec("INSERT INTO `dsa_bewerberdaten`
								   SET
									`code` = '$code',
									`md5` = '$summe',
									`status` = 'gesendet',
									`nachname` = '$nachname',
									`vorname` = '$vorname',
									`geschlecht` = '$geschlecht',
									`geburtsdatum` = '$geburtsdatum',
									`geburtsort` = '$geburtsort',
									`geburtsland` = '$geburtsland',
									`zuzug` = '$zuzug',
									`staatsangehoerigkeit` = '$staatsangehoerigkeit',
									`muttersprache` = '$muttersprache',
									`religion` = '$religion',
									`herkuftsland` = '$herkuftsland',
									`strasse` = '$strasse',
									`plz` = '$plz',
									`wohnort` = '$wohnort',
									`hausnummer` = '$hausnummer',
									`telefon1` = '$telefon1',
									`telefon2` = '$telefon2',
									`mail` = '$mail',
									`schulart` = '$schulart',
									`schulname` = '$schulname',
									`jahrgang` = '$jahrgang',
									`abschluss` = '$abschluss',
									
									`sorge1_vorname` = '$sorge1_vorname',
									`sorge1_nachname` = '$sorge1_nachname',
									`sorge1_anrede` = '$sorge1_anrede',
									`sorge1_art` = '$sorge1_art',
									`sorge1_strasse` = '$sorge1_strasse',
									`sorge1_hausnummer` = '$sorge1_hausnummer',
									`sorge1_plz` = '$sorge1_plz',
									`sorge1_wohnort` = '$sorge1_wohnort',
									`sorge1_telefon1` = '$sorge1_telefon1',
									`sorge1_telefon2` = '$sorge1_telefon2',
									`sorge1_mail` = '$sorge1_mail',
									
									`sorge2_vorname` = '$sorge2_vorname',
									`sorge2_nachname` = '$sorge2_nachname',
									`sorge2_anrede` = '$sorge2_anrede',
									`sorge2_art` = '$sorge2_art',
									`sorge2_strasse` = '$sorge2_strasse',
									`sorge2_hausnummer` = '$sorge2_hausnummer',
									`sorge2_plz` = '$sorge2_plz',
									`sorge2_wohnort` = '$sorge2_wohnort',
									`sorge2_mail` = '$sorge2_mail',
									`sorge2_telefon1` = '$sorge2_telefon1',
									`sorge2_telefon2` = '$sorge2_telefon2'")) {
					
					$last_id = $db_temp->lastInsertId();
					
					if ($db_temp->exec("INSERT INTO `dsa_bildungsgang`
								   SET
									`id_dsa_bewerberdaten` = '$last_id',
									`md5` = '$summe',
									`prio` = '$prio_akt',
									`time` = '$time',
									`schulform` = '$schulform',
									`dauer` = '$dauer',
									`beginn` = '$beginn',
									`ende` = '$ende',
									`beruf` = '$beruf',
									`beruf_anz` = '$beruf_anz',
									`beruf2` = '$beruf2',
									`betrieb` = '$betrieb',
									`betrieb2` = '$betrieb2',
									`betrieb_plz` = '$betrieb_plz',
									`betrieb_ort` = '$betrieb_ort',
									`betrieb_strasse` = '$betrieb_strasse',
									`betrieb_hausnummer` = '$betrieb_hausnummer',
									`betrieb_telefon` = '$betrieb_telefon',
									`betrieb_mail` = '$betrieb_mail',
									`ausbilder_nachname` = '$ausbilder_nachname',
									`ausbilder_vorname` = '$ausbilder_vorname',
									`ausbilder_telefon` = '$ausbilder_telefon',
									`ausbilder_telefon2` = '$ausbilder_telefon2',
									`ausbilder_mail` = '$ausbilder_mail',
									`bgy_sp1` = '$bgy_sp1',
									`bgy_sp2` = '$bgy_sp2',
									`bgy_sp3` = '$bgy_sp3',
									`fs1` = '$fs1',
									`fs1_von` = '$fs1_von',
									`fs1_bis` = '$fs1_bis',
									`fs2` = '$fs2',
									`fs2_von` = '$fs2_von',
									`fs2_bis` = '$fs2_bis',
									`fs3` = '$fs3',
									`fs3_von` = '$fs3_von',
									`fs3_bis` = '$fs3_bis'")) {
					
						$last_id = $db_temp->lastInsertId();
						
						
						$timestamp = time();
						$datum = date("Y-m-d");
						
						if ($db_temp->exec("INSERT INTO `summen`
								   SET
								   `time` = '$timestamp',
								   `papierkorb` = '0',
								   `schulform` = '$schulform',
								   `prio` = '$prio_akt',
								   `md5_o_sf` = '$summe_o_sf',
									`md5` = '$summe'")) {
					
						$last_id = $db_temp->lastInsertId();
						
						if ($schulform != "bs") {
							
							$umfrage1 = $_POST['umfrage1'];
							$umfrage2 = $_POST['umfrage2'];
							$umfrage3 = $_POST['umfrage3'];
							$umfrage4 = $_POST['umfrage4'];
							$umfrage5 = $_POST['umfrage5'];
							$umfrage6 = $_POST['umfrage6'];
							$umfrage7 = $_POST['umfrage7'];
							$umfrage8 = $_POST['umfrage8'];
							$umfrage9 = $_POST['umfrage9'];
							$umfrage10 = $_POST['umfrage10'];
							$umfrage11 = $_POST['umfrage11'];
							
							
							if ($db_temp->exec("INSERT INTO `umfrage`
									   SET
									   `zeit` = '$datum',
									   `umfrage1` = '$umfrage1',
									   `umfrage2` = '$umfrage2',
									   `umfrage3` = '$umfrage3',
									   `umfrage4` = '$umfrage4',
									   `umfrage5` = '$umfrage5',
									   `umfrage6` = '$umfrage6',
									   `umfrage7` = '$umfrage7',
									   `umfrage8` = '$umfrage8',
									   `umfrage9` = '$umfrage9',
									   `umfrage10` = '$umfrage10',
									   `umfrage11` = '$umfrage11',
										`md5` = '$summe'")) {
						
										}
						}
									
									
						echo "<p><b>Ihre Anmeldung wurde erfolgreich gespeichert!</b></p>";
						echo "<div style='padding: 10px; background-color: #E0E0E0; margin-bottom: 20px; border: 2px solid red;'>";
						echo "<p><b>Laden Sie sich bitte die PDF-Datei <a href='./pdf.php' target='_blank'>anmeldung-bbs1-mainz.pdf</a> herunter!</b></p>";
						
						
						if ($_SESSION['schulform'] != "bs") {
						echo "<p>Sie enthält ein vorgefertigtes Anschreiben zur Zusendung weiterer Bewerbungsunterlagen und die wichtigsten Informationen zu Ihrer Einschulung.<p>";
						} else {
						echo "<p>Sie enthält die wichtigsten Informationen zu Ihrer Einschulung.<p>";
						
						}
						echo "</div>";
						
						
						$schulform = $_SESSION['schulform'];
						
						$select_tex = $db_temp->query("SELECT * FROM senden_texte WHERE schulform = '$schulform' ORDER BY bezeichnung ASC");
						$treffer_tex = $select_tex->rowCount();
						
						foreach($select_tex as $tex) {
							
							if ($tex['text'] != "") {
								echo "<div class='box-grau' style='width: 100%;'>";
								echo "<h2>Bitte beachten Sie folgende Informationen:</h2>";
								echo $tex['text'];
								echo "</div>";
								$_SESSION['text_sf'] = $tex['text'];
							}
							
						}
						
						//Upload Dokumente:
						
					if ($_SERVER['REMOTE_ADDR'] != "217.198.244.140_aus" AND $upload_dokumente == 1 AND $_SESSION['schulform'] != "bs") {
						//Die Einstellung $upload_dokumente o.ä. muss auch im Verwaltungsnetz entsprechend in config.php eingestellt sein!

						echo "<hr style='border: 3px solid #4c6586; margin-top: 3em; margin-bottom: 0em;'>";
						echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<img src='./images/upload3.svg' width='130px'>";
						echo "</td>";
						echo "<td style='padding-left: 2em;'>";
						echo "<h2>Upload von Dokumenten als PDF-Datei</h2>";
						echo "Unterlagen, die wir nicht in beglaubigter Form benötigen <i>(z.B. Halbjahreszeugnis, Lebenslauf und Personalausweis)</i>, können Sie hier hochladen.<br>
						Die Zusendung per Post oder eine persönliche Abgabe im Sekretariat ist für diese Dokumente dann nicht mehr erforderlich.";

						echo "<form action='senden.php' method='post' enctype='multipart/form-data'>";
						echo "<p>Wählen Sie eine Datei zum Hochladen aus:</p>";
						echo "<input type='file' accept='.pdf,application/pdf' name='uploaded_file'>";
						echo "<input type='submit' style='margin-top: 1.3em;' class='btn btn-default btn-sm' name='upload_submit' value='Hochladen und verschlüsseln'>";
						echo "</form>";
						echo "</td>";
						echo "</tr>";
						echo "</table>";
						echo "<hr style='border: 3px solid #4c6586; margin-top: 0.7em; margin-bottom: 3em;'>";
						}
						
						
								 echo "<p>&nbsp;</p>";
								echo "<form id='form_n' method='post' action='./index.php'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_n' type='submit' name='submit_neu' value='weitere Anmeldung erstellen'>";
								echo "</form>";
								echo "<p>&nbsp;</p>";
								echo "<form id='form_w' method='post' action='https://www.bbs1-mainz.com'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_w' type='submit' name='submit_website' value='zu unserer Website'>";
								echo "</form>";
						
									}

						
						}

					}

} else {//Ende Vollständigkeit der Eingaben prüfen
	echo "Ihre Angaben sind unvollständig!";
	
								echo "<p>&nbsp;</p>";
								echo "<form id='form_n' method='post' action='./index.php'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_n' type='submit' name='submit_neu' value='Formular erneut durchgehen'>";
								echo "</form>";
}
	
} else {
	


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senden</title>
    <style>


.box-grau {
   padding: 10px;
   background-color: #E0E0E0;
   margin-bottom: 20px;
}

* {
  box-sizing: border-box;
}

.flex-container {
  display: flex;
  flex-direction: row;
  text-align: center;
}
      .hidden {
            display: none;
        }  
		
.flex-item-left {
  padding: 10px;
  flex: 50%;
  text-align: left;
}

.flex-item-right {
  padding: 10px;
  flex: 50%;
  text-align: left;
}

.flex-item-drei {
  padding: 10px;
  flex: 33.3%;
  text-align: left;
}

/* Responsive layout - makes a one column-layout instead of two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
  }
  

}
</style>
</head>
<body>
    <h1>Absenden der Anmeldung</h1>

 <form id="inputForm" action="senden.php" method="post">

	<?php
	
	//Prüfen, ob bereits eine Anmeldung vorliegt:

// In der selben Schulform:
$select_sum = $db_temp->query("SELECT md5, time FROM summen WHERE md5 = '$summe' AND papierkorb NOT LIKE '1'");	
$treffer_sum = $select_sum->rowCount();
foreach($select_sum as $sum) {
	$erste = $sum['time'];
}

// In in der selben oder anderen Schulform:

//$select_an = $db_temp->query("SELECT DISTINCT dsa_bewerberdaten.*, dsa_bildungsgang.* FROM dsa_bewerberdaten LEFT JOIN dsa_bildungsgang ON dsa_bildungsgang.id_dsa_bewerberdaten = dsa_bewerberdaten.id WHERE nachname LIKE '%$nachname%' AND vorname LIKE '%$vorname%' AND geburtsdatum = '$geburtsdatum' GROUP BY dsa_bewerberdaten.id");
	$select_an = $db_temp->query("SELECT md5, time FROM summen WHERE md5_o_sf = '$summe_o_sf'");
	
	$treffer_an = $select_an->rowCount();

//if ($treffer_an > 0 AND $_SERVER['REMOTE_ADDR'] == "217.198.244.140") {
	
if ($treffer_an > 0 AND $treffer_sum == 0) {
	
	echo "<p>Sie haben sich bereits für einen weiteren Bildungsgang angemeldet.<br>";
	echo "Um Sie möglichst in Ihrem bevorzugten Bildungsgang einschulen zu können, bitten wir Sie Ihre Anmeldungen zu priorisieren:</p>";
	

    
	
	
		
	if ($treffer_an > 0) {
				
		echo "<table style='margin: 30 0 30 0;'>";	
		
		//Zeilen für Wünsche:
		
		$w_nr = 0;
		foreach ($select_an as $an) {		
		
			$w_nr = ($w_nr + 1);
				
				echo "<tr>";
				echo "<td>";
				echo "<b>Wunsch ".$w_nr .":</b>";
				echo "</td>";
				echo "<td width='20px'>";
				echo "<td>";
				echo "<select style='width:100%; font-size: 16;' name='prio_".$w_nr."' required='required'>";
				//echo "<select style='width:100%; font-size: 16;' name='prio_2'>";
				//value:

				echo "<option value=''></option>";
	
			//$select_an2 = $db_temp->query("SELECT DISTINCT dsa_bewerberdaten.*, dsa_bildungsgang.* FROM dsa_bewerberdaten LEFT JOIN dsa_bildungsgang ON dsa_bildungsgang.id_dsa_bewerberdaten = dsa_bewerberdaten.id WHERE nachname LIKE '%$nachname%' AND vorname LIKE '%$vorname%' AND geburtsdatum = '$geburtsdatum' GROUP BY dsa_bewerberdaten.id");
			$select_an2 = $db_temp->query("SELECT * FROM summen WHERE md5_o_sf = '$summe_o_sf'");

			//Die Schulformen der vorhandenen Anmeldungen:
			foreach($select_an2 as $an2) { //Für jede Anmeldung die Schulform auflisten
			

			
			$sf_list = $an2['schulform'];
				$select_sf = $db_temp->query("SELECT DISTINCT name, kuerzel FROM schulformen WHERE kuerzel = '$sf_list'");
				foreach($select_sf as $sf) {
					
					echo "<option value='".$sf['kuerzel']."'>".$sf['name']."</option>";
					
				}
			
				
			}
			$sf_list = $an2['schulform'];
				$select_sf = $db_temp->query("SELECT DISTINCT name, kuerzel FROM schulformen WHERE kuerzel = '$schulform'");
				foreach($select_sf as $sf) {
					
					echo "<option value='".$sf['kuerzel']."'>".$sf['name']."</option>";
					
				}
								echo "</select><br><br>";
				echo "</td>";
				echo "</tr>";
		}
				//Wunschzeile der aktuellen Anmeldung:
				$w_nr = ($w_nr + 1);
				
				echo "<tr>";
				echo "<td>";
				echo "<b>Wunsch ".($w_nr) .":</b>";
				echo "</td>";
				echo "<td width='20px'>";
				echo "<td>";
				echo "<select style='width:100%; font-size: 16;'name='prio_".$w_nr."' required='required'>";
				
				//value:

				echo "<option value=''></option>";
			
			//$select_an3 = $db_temp->query("SELECT DISTINCT dsa_bewerberdaten.*, dsa_bildungsgang.* FROM dsa_bewerberdaten LEFT JOIN dsa_bildungsgang ON dsa_bildungsgang.id_dsa_bewerberdaten = dsa_bewerberdaten.id WHERE nachname LIKE '%$nachname%' AND vorname LIKE '%$vorname%' AND geburtsdatum = '$geburtsdatum' GROUP BY dsa_bewerberdaten.id");
				$select_an3 = $db_temp->query("SELECT * FROM summen WHERE md5_o_sf = '$summe_o_sf'");
			
			foreach($select_an3 as $an3) { //Für jede Anmeldung die Schulform auflisten
			$sf_list = $an3['schulform'];
				$select_sf = $db_temp->query("SELECT DISTINCT name, kuerzel FROM schulformen WHERE kuerzel = '$sf_list'");
				foreach($select_sf as $sf) {
					
					echo "<option value='".$sf['kuerzel']."'>".$sf['name']."</option>";
					
				}
				
			}
			$sf_list = $an2['schulform'];
				$select_sf = $db_temp->query("SELECT DISTINCT name, kuerzel FROM schulformen WHERE kuerzel = '$schulform'");
				foreach($select_sf as $sf) {
					
					echo "<option value='".$sf['kuerzel']."'>".$sf['name']."</option>";
					
				}
				
					
				
				echo "</select><br><br>";
				echo "</td>";
				echo "</tr>";
	echo "</table>";		
		}
		
}

   		 //Umfrage:
		 if ($umfrage == 1 AND file_exists("./umfrage.php") AND $schulform != "bs" AND $treffer_sum == 0) {
			include("./umfrage.php");
		 }
	

	if (isset($_POST['submit_weiter']) AND $_POST['dsgvo'] != "1") {
		echo "<font color='red'><b>Ohne Kenntnisnahme Zustimmung zu unserer Datenschutzerklärung können wir Ihre Anmeldung nicht annehmen!</b></font>";
	}
	?>
	
	<fieldset> 
	<input type="checkbox" name="dsgvo" value="1" id="dsgvo">
	<label for="dsgvo"><b>Ich stimme der Datenerfassung gemäß der <a href='./datenschutzerklaerung.pdf' target='_blank'>Datenschutzerkärung der BBS1-Mainz</a> zu.</b></label>
	</fieldset>
	<p></p>
	
   <?php
   

		
		if ($treffer_sum == 0) {
         echo "<input style='width: 14em;' class='btn btn-default btn-sm' id='inputForm' type='submit' name='submit_weiter' value='Anmeldung abschicken'>";
		 
		 echo "<p>&nbsp;</p>";
		 

		 
		 
		} else {
			echo "<p>".$vorname." ".$nachname." hat sich bereits für diese Schulform angemeldet.<br>
			Die Anmeldung erfolgte am ".date("d.m.Y",$erste)." um ".date("H:i",$erste)." Uhr.</p>
			<p><b>Eine weitere Anmeldung für die selbe Schulform ist nicht möglich!</b>";
			
		}
		
		
		
		
		
	?>	
    </form>
		<?php
	if ($_SESSION['schulform'] == "bgy" OR $_SESSION['schulform'] == "bf1" OR $_SESSION['schulform'] == "bf2" OR $_SESSION['schulform'] == "bos1" OR $_SESSION['schulform'] == "bos2" OR $_SESSION['schulform'] == "fs" OR $_SESSION['schulform'] == "hbf") {
		echo "<form id='form_z' method='post' action='./zusatz.php'>";
	} else {
		echo "<form id='form_z' method='post' action='./eltern.php'>";
	}
	?>
	<p>&nbsp;</p>
		<input style='width: 12em;' method='post' action='./index.php' id='form_z' type="submit" name='submit_zurueck' value="zurück">
	</form>
	
	
		<form id='form_n' method='post' action='http://www.bbs1-mainz.com'>
		<input style='width: 12em;' method='post' id='form_n' type="submit" name='submit_neu' value="zu unserer Website">
	</form>
	
	
</body>
</html>
<?php
} //Ende für nicht submit

} //ENDE kein Dateiupload

include("./fuss.php");

?>
