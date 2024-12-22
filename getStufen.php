<?php
// getStufen.php

@session_start();

include("./config.php"); // Stelle sicher, dass die Verbindung zur Datenbank hergestellt wird.



		if ($_SESSION['jahrgang'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['jahrgang'];
		$select_st_k = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['anzeigeform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	echo "<option value='test'>test</option>";
			$select_st = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen ORDER BY schluessel ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['anzeigeform']."</option>";
				
			}



		

if(isset($_GET['schulart_kuerzel'])) {
    $schulart_kuerzel = $_GET['schulart_kuerzel'];
	
	if ($schulart_kuerzel == "RS") {
	$query = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen WHERE kurzform = '8'");
	} else {
		$query = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen");
	
	}
	
    echo "<option value='' disabled selected hidden>Bitte wählen...</option>";
    foreach($query as $row) {
		echo "<option value='".$row['kurzform']."'>".$row['anzeigeform']."</option>";
		
    }

}
?>
