<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Stelle eine Verbindung zur Datenbank her
$db = new mysqli('127.0.0.1', 'demo_user', 'ZzEzIBn[uHq711@v', 'anmeldung_www_demo2');

// Überprüfe die Verbindung
if ($db->connect_error) {
    die('Verbindungsfehler: ' . $db->connect_error);
}

// Führe die SELECT-Abfrage aus
$result = $db->query("SELECT * FROM dsa_bewerberdaten");

if (!$result) {
    die('Abfragefehler: ' . $db->error);
}

$columns = [];
$values = [];

// Erhalte die Spaltennamen mit einer alternativen Methode
$meta = $result->fetch_fields();
foreach ($meta as $field) {
    if ($field->name != 'id' && $field->name != 'md5' && $field->name != 'plz' && $field->name != 'wohnort' && $field->name != 'sorge1_plz' && $field->name != 'sorge2_plz' && $field->name != 'sorge1_wohnort' && $field->name != 'sorge2_wohnort') {
        $columns[] = $field->name;
        $values[$field->name] = [];
    }
}

// Daten in Arrays speichern
while ($row = $result->fetch_assoc()) {
    foreach ($columns as $column) {
        $values[$column][] = $row[$column];
    }
}

// Mische die Werte in jedem Array
foreach ($columns as $column) {
    shuffle($values[$column]);
}

// Update die Tabelle mit den gemischten Werten
for ($i = 0; $i < count($values[$columns[0]]); $i++) {
    $updateParts = [];
    foreach ($columns as $column) {
        $updateParts[] = "$column = '".$db->real_escape_string($values[$column][$i])."'";
    }
    $updateQuery = "UPDATE dsa_bewerberdaten SET " . join(', ', $updateParts) . " WHERE id = (SELECT id FROM (SELECT id FROM dsa_bewerberdaten ORDER BY id LIMIT 1 OFFSET $i) AS temp)";
    
    if (!$db->query($updateQuery)) {
        echo "Fehler beim Aktualisieren der Daten: " . $db->error;
    }
}

//Mailadressen anonymisieren:
/*
if ($db->query("UPDATE `dsa_bewerberdaten`
								   SET
								   `sorge1_mail` = 'demo@xyz.de',
								   `sorge2_mail` = 'demo@xyz.de',
									`mail` = 'demo@xyz.de'")) { 
	
									}
									*/
									if ($db->query("UPDATE `dsa_bewerberdaten`
									SET
								   `sorge1_mail` = 'demo@xyz.de' WHERE sorge1_mail NOT LIKE ''")) { 
									}
									if ($db->query("UPDATE `dsa_bewerberdaten`
									SET
								   `sorge2_mail` = 'demo@xyz.de' WHERE sorge2_mail NOT LIKE ''")) { 
									}
									if ($db->query("UPDATE `dsa_bewerberdaten`
									SET
								   `mail` = 'demo@xyz.de' WHERE mail NOT LIKE ''")) { 
									}
									

echo "Daten erfolgreich anonymisiert.";

// Schließe die Datenbankverbindung
$db->close();
?>
