<?php
// getBetriebe.php

include("./config.php"); // Stelle sicher, dass die Verbindung zur Datenbank hergestellt wird.

if(isset($_GET['berufSchluessel'])) {
    $berufSchluessel = $_GET['berufSchluessel'];
    $query = $db_temp->query("SELECT betrieb_kuerzel, betrieb_name1, betrieb_name2 FROM berufe_angebot_betriebe WHERE schluessel LIKE '$berufSchluessel'");

    echo "<option value='' disabled selected hidden>Bitte wählen...</option>";
    foreach($query as $row) {
        echo "<option value='".$row['betrieb_kuerzel']."'>".$row['betrieb_name1']."</option>";
    }

    // Hinzufügen der Option für "sonstiger" am Ende der Liste
    echo "<option value='sonstiger'>sonstiger</option>";
}
?>
