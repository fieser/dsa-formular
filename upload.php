<?php
include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();

	//md5-summe ohne Schulform bildenn:
//	$summe_o_sf = md5($mail.$geburtsdatum);


$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];

/*
if ($summe_o_sf == "") {
$summe_o_sf = $_GET['id'];
}
*/

if (isset($_GET['id'])) {
	$_SESSION['id_upload'] = $_GET['id'];
}

if (isset($_GET['id2']) AND !isset($_SESSION['plz'])) {
	$_SESSION['plz'] = $_GET['id2'];
}

if (isset($_POST['plz_submit'])) {
	
	$_SESSION['plz'] = $_POST['plz'];
	
	
	
	if ($_SESSION['id_upload'] != md5($_POST['mail'].$_POST['geburtsdatum'])) {
	header("Location: ./upload.php?id=".$_SESSION['id_upload']."&fehler=1");
	$_SESSION['plz'] = "";
	}
	
}

//Prüfen, ob das Geburtsdatum stimmt:




include("./config.php");

			// Imagick einbinden, ohne Composer
			function convertImageToPDF($imageFile, $pdfFile) {
				$imagick = new Imagick($imageFile);
				$imagick->setImageFormat('pdf');
				$imagick->writeImages($pdfFile, true);
				unlink($imageFile); // Ursprüngliche Bilddatei löschen
				return $pdfFile;
			}


			function encryptFile($sourceFile, $destFile, $passphrase) {
			$key = openssl_digest($passphrase, 'SHA256', TRUE);
			$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

			$fileContent = file_get_contents($sourceFile);
			$encrypted = openssl_encrypt($fileContent, 'aes-256-cbc', $key, 0, $iv);

			// IV an den Anfang des verschlüsselten Inhalts hängen
			$result = file_put_contents($destFile, $iv . $encrypted);
			unlink($sourceFile); // Ursprüngliche Datei löschen
			return $result !== false;
		}

		if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['uploaded_file'])) {
			if ($_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK) {
				$uploadDir = 'dokumente/';
				$uploadedFile = $_FILES['uploaded_file']['tmp_name'];
		
				$fileType = mime_content_type($uploadedFile);
				$allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'];
		
				if (!in_array($fileType, $allowedTypes)) {
					echo "<h2><b><font color='red'>Bitte laden Sie nur PDF oder Bilddateien (JPG, PNG, GIF) hoch!</font></b></h2>";
					exit;
				}
		
				if ($fileType !== 'application/pdf') {
					$newPDFPath = $uploadDir . pathinfo($_FILES['uploaded_file']['name'], PATHINFO_FILENAME) . '.pdf';
					$uploadedFile = convertImageToPDF($uploadedFile, $newPDFPath);
					$fileType = 'application/pdf';
				}
		
			
			$destFile = $uploadDir.$_SESSION['id_upload'].'.enc';
			$fileName = $_SESSION['id_upload'].'.'.time().'.pdf.enc';

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
			if (isset($_SESSION['mail'])) { 
			$password = md5(md5($_SESSION['mail'].$_SESSION['geburtsdatum']).$_SESSION['plz']);  // Dies sollte in einer sicheren Konfigurationsdatei gespeichert werden
			} else {
				$password = md5($_SESSION['id_upload'].$_SESSION['plz']);  // Dies sollte in einer sicheren Konfigurationsdatei gespeichert werden

			}
			
			
			//echo $password."<br>";
			
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
				echo "<h2><b><font color='red'>Fehler bei der Verschlüsselung der Datei.</font></b></h2>";
			}
		
    } else if ($_FILES['uploaded_file']['error'] === UPLOAD_ERR_NO_FILE) {
        // Keine Datei wurde hochgeladen
        echo "<h2><b><font color='red'>Bitte wählen Sie eine Datei zum Hochladen aus!</font></b></h2>";
    } else {
        // Andere Fehler beim Hochladen
        echo "<h2><b><font color='red'>Fehler beim Hochladen der Datei. Bitte versuchen Sie es erneut.</font></b></h2>";
    }
} else {
    // Keine POST-Anfrage oder keine Datei im POST
    //echo "<p><strong>Bitte verwenden Sie das Formular zum Hochladen von Dateien.</strong></p>";
}
								//Buttons:
		if (isset($_POST['upload_submit'])) {
								
								echo "<p><b>Nutzen Sie folgenden Link, um jetzt oder später weitere Dokumente zu Ihrer Anmeldung hochzuladen.</b></p>";
								echo "<b><a href='".$url."upload.php?id=".$_SESSION['id_upload']."&id2=".$_SESSION['plz']."'>".$url."upload.php?id=".$_SESSION['id_upload']."&id2=".$_SESSION['plz']."</a></b><br>";
								echo "<div style='margin-top: 1em;'><small>(Um diesen Link später nutzen zu können, müssen Sie ihn jetzt speichern oder notieren.)</small></div>";
								echo "<p>&nbsp;</p>";
								echo "<form id='form_n' method='post' action='./index.php'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_n' type='submit' name='submit_neu' value='weitere Anmeldung erstellen'>";
								echo "</form>";
								echo "<p>&nbsp;</p>";
								echo "<form id='form_w' method='post' action='".$website."'>";
								echo "<input  style='width: 20em;' class='btn btn-default btn-sm'  method='post' id='form_w' type='submit' name='submit_website' value='zu unserer Website'>";
								echo "</form>";
								
		} else {
			
			//Wenn noch keine PLZ angegeben wurde:
			if ($_SESSION['plz'] == "") {
				
				if ($_GET['fehler'] == 1) {
					
					echo "<p><font color='red'><b>Ihre Angeben stimmen nicht mit den Daten der ursprünglichen Anmeldung überein!</b></font></p>";
				}
				
				echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<img src='./images/upload3.svg' width='130px'>";
						echo "</td>";
						echo "<td style='padding-left: 2em;'>";
						echo "<h2>Upload von Dokumenten als PDF- oder Bilddatei</h2>";
						echo "Bevor Sie PDF-Dokumente hochladen können benötigen wir noch ein paar Angaben:<br>";

						echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
						echo "<p>Die Postleitzahl vom angegebenen Wohnort der Schülerin oder des Schülers:</p>";
						echo "<input type='text' name='plz' required>";
						
						echo "<p>Das Geburtsdatum der Schülerin oder des Schülers:</p>";
						echo "<input type='date' name='geburtsdatum' required>";
						
						echo "<p>Die angegebene E-Mail-Adresse der Schülerin oder des Schülers:</p>";
						echo "<input type='email' name='mail' required>";
						
						echo "<p><input type='submit' style='margin-top: 1.3em;' class='btn btn-default btn-sm' name='plz_submit' value='bestätigen'></p>";
						
						
						echo "</form>";
						echo "</td>";
						echo "</tr>";
						echo "</table>";
				
				
			} else {
						//echo "<hr style='border: 3px solid #4c6586; margin-top: 3em; margin-bottom: 0em;'>";
						echo "<table>";
						echo "<tr>";
						echo "<td>";
						echo "<img src='./images/upload3.svg' width='130px'>";
						echo "</td>";
						echo "<td style='padding-left: 2em;'>";
						echo "<h2>Upload von Dokumenten als PDF- oder Bilddatei</h2>";
						if ($upload_dokumente == 1) {
							echo "Unterlagen, die wir nicht in beglaubigter Form benötigen <i>(z.B. Halbjahreszeugnis, Lebenslauf und Personalausweis)</i>, können Sie hier hochladen.<br>
							Die Zusendung per Post oder eine persönliche Abgabe im Sekretariat ist für diese Dokumente dann nicht mehr erforderlich.";

							echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
							echo "<p>Wählen Sie eine Datei zum Hochladen aus:</p>";
							echo "<input type='file' accept='.pdf,application/pdf' name='uploaded_file'>";
							echo "<input type='submit' style='margin-top: 1.3em;' class='btn btn-default btn-sm' name='upload_submit' value='Hochladen und verschlüsseln'>";
							echo "</form>";
						} else {
							echo "<p>Momentan ist leider kein Upload von Dokumenten möglich.</p>
							<p>Bitte versuchen Sie es an einem anderen Tag.</p>";
						}
						echo "</td>";
						echo "</tr>";
						echo "</table>";
						//echo "<hr style='border: 3px solid #4c6586; margin-top: 0.7em; margin-bottom: 3em;'>";
			}
		}
		
		include("./fuss.php");
?>
