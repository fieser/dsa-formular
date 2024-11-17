<?php
// getBetriebe.php

@session_start();

include("./config.php"); // Stelle sicher, dass die Verbindung zur Datenbank hergestellt wird.

if ($_SESSION['betrieb'] != "") {
			$kuerzel_betrieb = $_SESSION['betrieb'];
		$select_be_k = $db_temp->query("SELECT kuerzel, name1, name2 FROM betriebe WHERE kuerzel LIKE '$kuerzel_betrieb'");
		foreach($select_be_k as $be_k) {
		echo "<option value='".$be_k['kuerzel']."'>".$be_k['name1']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		
		    // Hinzufügen der Option für "sonstiger" am Anfang der Liste
    echo "<option value='sonstiger'>sonstiger</option>";
	echo "<option value='' disabled>-----------------------</option>";

if(isset($_GET['berufSchluessel'])) {
    $berufSchluessel = $_GET['berufSchluessel'];
	if ($berufSchluessel != "sonstiger") {
		$query = $db_temp->query("SELECT betrieb_kuerzel, betrieb_name1, betrieb_name2 FROM berufe_angebot_betriebe WHERE schluessel LIKE '$berufSchluessel' ORDER BY betrieb_name1 ASC");
		
	} else {
		$query = $db_temp->query("SELECT DISTINCT betrieb_kuerzel, betrieb_name1, betrieb_name2 FROM berufe_angebot_betriebe ORDER BY betrieb_name1 ASC");
	}
    echo "<option value='' disabled selected hidden>Bitte wählen...</option>";
    foreach($query as $row) {
		if (substr($row['betrieb_name1'],0,3) != "ZZZ" AND substr($row['betrieb_name1'],0,3) != "AAA" AND $row['betrieb_name1'] != "") {
        echo "<option value='".$row['betrieb_kuerzel']."'>".$row['betrieb_name1']."</option>";
		}
    }
	
	//Wenn sehr wenige Ergebnisse, dann unterhalb alle weiteren auflisten:
		$treffer_betriebe = $query->rowCount();
		if ($treffer_betriebe < $min_anzahl_betriebe) {
			echo "<option value='' disabled>-----------------------</option>";
			
			$query_w = $db_temp->query("SELECT DISTINCT betrieb_kuerzel, betrieb_name1, betrieb_name2 FROM berufe_angebot_betriebe ORDER BY betrieb_name1 ASC");
			foreach($query_w as $row_w) {
				if (substr($row_w['betrieb_name1'],0,3) != "ZZZ" AND substr($row_w['betrieb_name1'],0,3) != "AAA" AND $row_w['betrieb_name1'] != "") {
				echo "<option value='".$row_w['betrieb_kuerzel']."'>".$row_w['betrieb_name1']."</option>";
				}
			}
			
		}


}
?>
