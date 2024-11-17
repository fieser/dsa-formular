<?php

include("/var/www/html/anmeldung/config.php");


// Dateiname und Verzeichnis der zu überprüfenden Datei
$zipFile = '/var/www/html/anmeldung/dokumente/dokumente.zip';

// Abrufen des Timestamps der letzten Änderung der Datei
$fileModificationTime = file_exists($zipFile) ? filemtime($zipFile) : false;

// Abrufen des letzten Download-Zeitpunkts aus der Datenbank
$select_log = $db_temp->query("SELECT wert FROM log WHERE name LIKE 'last_download'");
$last_download = "";
foreach ($select_log as $log) {
    $last_download = $log['wert'];
}
//echo $last_download."<br>";
//echo ($fileModificationTime + 30 * 60); 

// Überprüfen, ob der Timestamp aus der Datenbank 30 Minuten jünger ist als das Änderungsdatum der Datei
if ($last_download && $fileModificationTime && ($last_download > ($fileModificationTime + 30 * 60))) {
    $directory = '/var/www/html/anmeldung/dokumente'; // Verzeichnis, in dem die Dateien gespeichert sind.

    // Dateien im Verzeichnis auflisten
    $files = scandir($directory);
    foreach ($files as $file) {
        // Überprüfen, ob die Datei den spezifischen Namensteil vor dem ersten Punkt im Namen hat und nicht .htaccess ist
        if (pathinfo($file, PATHINFO_EXTENSION) && $file !== '.htaccess') {
            // Vollständigen Pfad zur Datei generieren
            $filePath = $directory . '/' . $file;

            // Datei löschen
            if (unlink($filePath)) {
                echo "Datei '$file' erfolgreich gelöscht.<br>";
            } else {
                echo "Fehler beim Löschen der Datei '$file'.<br>";
            }
        }
    }
} else {
    echo "Die Bedingungen zum Löschen der Dateien wurden nicht erfüllt.";
}

?>
