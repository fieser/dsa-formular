<?php

// Adminrechte:

	if ($_SESSION['username'] = "bbsTester") {
		
		$_SESSION['admin'] = 1;
		$rechte = "Administrator/-in";
		
	} else {	
		
		$_SESSION['admin'] = 1;

	}

//FT-Rechte:

	if ($_SESSION['test_lk'] != 1 AND ($_SESSION['admin'] == 1 OR $_SESSION['username'] == "Fieser" OR $_SESSION['username'] == "vogt" OR $_SESSION['username'] == "reimer" OR ($_SESSION['username'] == "wiedemuth" OR $_SESSION['username'] == "Frick" OR $_SESSION['username'] == "stenger" OR $_SESSION['username'] == "Wiss" OR $_SESSION['username'] == "Dikau" OR $_SESSION['username'] == "Orlob-Groh"))) {
		
		$_SESSION['ft'] = 1;
		
		if ($_SESSION['admin'] == 0) {
			$rechte = "Abteilungsleitung/Stundenplanung";
		}
		
	} else {
		
		$_SESSION['ft'] = "false";
		
		if ($_SESSION['ft'] != 1 AND $_SESSION['admin'] != 1) {
			$rechte = "Lehrkraft";
		}
	}
	

	
	//Sekretariats-Rechte
	
	if ($_SESSION['username'] == "reimer" OR $_SESSION['username'] == "ohlenmacher" OR $_SESSION['username'] == "luzius" OR $_SESSION['username'] == "g.mueller" OR $_SESSION['username'] == "soyer" OR $_SESSION['username'] == "azubi") {
	//if ($_SESSION['username'] == "Fieser") {
		$_SESSION['sek'] = 1;
		$rechte = "sekretariat";
	}
	

?>
