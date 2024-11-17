<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");






if (isset($_POST['nachname'])) {
	$_SESSION['nachname'] = $_POST['nachname'];
	$_SESSION['vorname'] = $_POST['vorname'];
	$_SESSION['geschlecht'] = $_POST['geschlecht'];
	$_SESSION['geburtsdatum'] = $_POST['geburtsdatum'];
	
	if ($_SESSION['geburtsdatum'] != "" AND (strtotime($_SESSION['geburtsdatum']) > (time() - 3600*24*365*12) OR strtotime($_SESSION['geburtsdatum']) < (time() - 3600*24*365*60))) {
		$fehlertext .= "<p><b>Das angegebene Geburtsdatum ist nicht plausibel!</b></p>";
	}
	
		
	// date("d.m.Y",strtotime($an['geburtsdatum']))
	
	$_SESSION['geburtsort'] = $_POST['geburtsort'];
	$_SESSION['geburtsland'] = $_POST['geburtsland'];
	$_SESSION['zuzug'] = $_POST['zuzug'];
	$_SESSION['staatsangehoerigkeit'] = $_POST['staatsangehoerigkeit'];
	$_SESSION['muttersprache'] = $_POST['muttersprache'];
	$_SESSION['religion'] = $_POST['religion'];
	$_SESSION['herkuftsland'] = $_POST['herkuftsland'];
	$_SESSION['strasse'] = $_POST['strasse'];
	
	//Korrekturen zur Straße:
	$_SESSION['strasse'] = str_replace("trasse","traße",$_SESSION['strasse']);
	$_SESSION['strasse'] = str_replace("heimerweg","heimer Weg",$_SESSION['strasse']);
	$_SESSION['strasse'] = str_replace("heimerstraße","heimer Straße",$_SESSION['strasse']);
	
	$_SESSION['plz'] = $_POST['plz'];
	$_SESSION['wohnort'] = $_POST['wohnort'];
	

	$_SESSION['hausnummer'] = $_POST['hausnummer'];
	$_SESSION['telefon1'] = $_POST['telefon1'];
	$_SESSION['telefon2'] = $_POST['telefon2'];
	$_SESSION['mail'] = $_POST['mail'];
	$_SESSION['schulart'] = $_POST['schulart'];
	$_SESSION['schulname'] = $_POST['schulname'];
	$_SESSION['jahrgang'] = $_POST['jahrgang'];
	$_SESSION['abschluss'] = $_POST['abschluss'];
	
	//Prüfung Abschluss für BGY:
	if ($_SESSION['abschluss'] != "S1" AND $_SESSION['abschluss'] != "FHST" AND $_SESSION['abschluss'] != "FHSPT" AND $_SESSION['abschluss'] != "NV" AND $_SESSION['schulform'] == "bgy") {
		$fehlertext .= "<p><b>Der angegebene (voraussichtlich) bis zum Eingritt in die BBS 1 erlangte Schulabschluss ist nicht plausibel!</b></p>";
	}
	
	//Prüfung Abschluss für HBF:
		if ($_SESSION['abschluss'] != "S1" AND $_SESSION['abschluss'] != "NV" AND $_SESSION['schulform'] == "hbf") {
		$fehlertext .= "<p><b>Der angegebene (voraussichtlich) bis zum Eingritt in die BBS 1 erlangte Schulabschluss ist nicht plausibel!</b></p>";
	}
	
		//Prüfung Abschluss für DBOS:
		if ($_SESSION['abschluss'] != "S1" AND $_SESSION['abschluss'] != "NV" AND $_SESSION['schulform'] == "dbos") {
		$fehlertext .= "<p><b>Der angegebene (voraussichtlich) bis zum Eingritt in die BBS 1 erlangte Schulabschluss ist nicht plausibel!</b></p>";
	}

	//PLZ und Wohnort prüfen:
	$plz = $_SESSION['plz'];
	
	    function levenshteinPerc($str1, $str2) {
        $len = strlen($str1);
        if ($len===0 AND strlen($str2)===0) {
            return 0;
        } else {
            return ($len>0 ? levenshtein($str1, $str2) / $len : 1);
        }
    }
	
	$select_pwo = $db_temp->query("SELECT * FROM plz_ort WHERE plz = '$plz'");
	$treffer_pwo = $select_pwo->rowCount();
	
	if ($treffer_pwo == 1) {
	
		/*
		foreach($select_pwo as $pwo) {
			$diff = levenshteinPerc($_POST['wohnort'],$pwo['ort']);
			//$diff = levenshtein($_POST['wohnort'], $pwo['ort']);
			$_SESSION['diff_wohnort'] = $diff;
			echo "Test: ".$diff;
		}
		*/
		
		//Ortsnahmen mit WL-Eintrag aus edoo.sys überschreiben:
		foreach($select_pwo as $pwo) {
			
			$_SESSION['wohnort'] = trim($pwo['ort']);
		
		}
	

	}
	
		if ($treffer_pwo > 1) {
		
		//Ortsnahmen mit WL-Eintrag aus edoo.sys überschreiben:
		foreach($select_pwo as $pwo) {
			
					
		
			$diff = levenshteinPerc($_POST['wohnort'],$pwo['ort']);
			//$diff = levenshtein($_POST['wohnort'], $pwo['ort']);
			$_SESSION['diff_wohnort'] = $diff;
			//echo "Test: ".$diff;
		
		$lev[$plz][$pwo['ort']]['diff'] = $diff;
		
		}
			//Ort der PLZ mit der kleinsten Abweiung finden:
			$minValue = PHP_INT_MAX;
			$minOrt = '';

			foreach ($lev as $plz => $orte) {
				foreach ($orte as $ort => $data) {
					if ($data['diff'] < $minValue) {
						$minValue = $data['diff'];
						$minOrt = $ort;
					}
				}
			}

//echo "Der Ort mit dem kleinsten Wert ist: " . $minOrt;

		

			$_SESSION['wohnort'] = trim($minOrt);

		
		
		
/*
echo "<pre>";
print_r ( $lev );
echo "</pre>";
*/

	}
		
if ($fehlertext == "") {
		
//PLZ nicht gefunden - ist egal und es geht weiter:
echo "<meta http-equiv='refresh' content=\"0; URL=./eltern.php\">";

}
	
} 

if (!isset($_POST['nachname']) OR $fehlertext != "") {




if (isset($_GET['sf'])) {
	$_SESSION['schulform'] = $_GET['sf'];
} else {
	if (isset($_SESSION['schulform'])) {
	//nichts zu tun
	} else {
		$_SESSION['schulform'] = "bs";
	}
}







?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerberdaten</title>
    <style>


.box-grau {
   padding: 10px;
   background-color: #E0E0E0;
   margin-bottom: 20px;
}

.box-fehler {
   padding: 10px;
   background-color: #F7819F;
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
<?php
$sf_kuerzel = $_SESSION['schulform'];

$select_sf = $db_temp->query("SELECT name FROM schulformen WHERE kuerzel = '$sf_kuerzel'");
		
		foreach($select_sf as $sf) {
		 
		 $sf_name = $sf['name'];
		 
		
		}
    echo "<h1><b>Bewerberdaten</b> <font style='font-size: 0.7em;'> - <i>Anmeldung ".$sf_name."</i></font></h1>";
	
	//Plausi-Feher anzeigen:
	
	if ($fehlertext != "") {
		
	echo "<div class='box-fehler'>".$fehlertext."</div>";
		
	}
	
	
	
?>
    <form id="inputForm" action="bewerberdaten.php" method="post">
<div class='box-grau'>	
<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="vorname">Vorname:</label><br>
        <input style='width:100%;' type="text" id="vorname" name="vorname" value='<?php echo $_SESSION["vorname"] ?>' required><br>
	</div>
		
	<div class="flex-item-right">
			<label for="nachname">Nachname:</label><br>
			<input style='width:100%;' type="text" id="nachname" name="nachname" value='<?php echo $_SESSION["nachname"] ?>' required><br>
	</div>
</div>

<div class="flex-container">
	<div class="flex-item-drei">
        <label>Geschlecht:</label><br>
	<select style='width:100%; font-size: 16;'name='geschlecht' required='required'>
	<?php
		if ($_SESSION['geschlecht'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['geschlecht'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM geschlecht WHERE anzeigeform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM geschlecht");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select><br><br>
	</div>
		
	<div class="flex-item-drei">
        <label for="geburtsdatum">Geburtsdatum:</label><br>
        <input style='width:100%;' type="date" id="geburtsdatum" name="geburtsdatum" value='<?php echo $_SESSION["geburtsdatum"] ?>' required><br>
	</div>
	
		<div class="flex-item-drei">
        <label for="geburtsort">Geburtsort:</label><br>
        <input style='width:100%;' style='width:100%;' type="text" id="geburtsort" name="geburtsort" value='<?php echo $_SESSION["geburtsort"] ?>' required><br>
	</div>
</div>

<div class="flex-container">
	
	<div class="flex-item-drei">
		<label for="geburtsland">Geburtsland:</label><br>
        <select style='width:100%; font-size: 16;' id="geburtsland" name="geburtsland" required='required' onchange="togglezuzugField()">
	<?php
		if ($_SESSION['geburtsland'] != "") {
			$kuerzel_geburtsland = $_SESSION['geburtsland'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM staaten WHERE anzeigeform LIKE '$kuerzel_geburtsland'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM staaten ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
					echo "<option value='DE'>Deutschland</option>";
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select><br><br>
		</div>
		
		<div class="flex-item-drei"  id="zuzugField">
        <label for="zuzug">Zuzug nach Deutschland:</label><br>
        <input style='width:100%;' type="date" id="zuzug" name="zuzug" value='<?php echo $_SESSION["zuzug"] ?>'><br>
		</div>

        <div class="flex-item-drei">
            <label>Staatsangehörigkeit:</label><br>
	<select style='width:100%; font-size: 16;'name='staatsangehoerigkeit' required='required'>
	<?php
		if ($_SESSION['staatsangehoerigkeit'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['staatsangehoerigkeit'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM staaten WHERE anzeigeform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM staaten ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
					echo "<option value='DE'>Deutschland</option>";
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select>
        </div><br><br>
 </div>		 
 
 <div class="flex-container">
	
	<div class="flex-item-drei">
		<label for="muttersprache">Muttersprache:</label><br>
	<select style='width:100%; font-size: 16;'name='muttersprache' required='required'>
	<?php
		if ($_SESSION['muttersprache'] != "") {
			$kuerzel_muttersprache = $_SESSION['muttersprache'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM sprachen WHERE anzeigeform LIKE '$kuerzel_muttersprache'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM sprachen ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
					echo "<option value='DE'>deutsch</option>";
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select><br><br>
		</div>
		

		
			<div class="flex-item-drei" id="herkunftField">
		<label for="herkunft">Herkunftsland <small>(nach DE eingereist aus)</small>:</label><br>
        <select style='width:100%; font-size: 16;' id="herkunft" name="herkuftsland">
	<?php
		if ($_SESSION['herkuftsland'] != "") {
			$kuerzel_herkuftsland = $_SESSION['herkuftsland'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM staaten WHERE anzeigeform LIKE '$kuerzel_herkuftsland'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM staaten ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
					echo "<option value='DE'>Deutschland</option>";
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select><br><br>
		</div>
		
					<div class="flex-item-drei">
		<label for="religion">Religionszugehörigkeit:</label><br>
        <select style='width:100%; font-size: 16;' id="religion" name="religion" required='required'>
	<?php
		if ($_SESSION['religion'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['religion'];
		$select_st_k = $db_temp->query("SELECT kurzform, anzeigeform FROM religion WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['anzeigeform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT kurzform, anzeigeform FROM religion ORDER BY sortierung ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['anzeigeform']."</option>";
				
			}
?>	
        </select><br><br>
		</div>
	</div>
	
	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="strasse">Straße:</label><br>
        <!-- <input style='width:100%;' type="text" id="strasse" name="strasse" value='<?php echo $_SESSION["strasse"] ?>' pattern="[a-zA-Zöäüß\-\.\s]+" required><br> -->
	 <input style='width:100%;' type="text" id="strasse" name="strasse" value='<?php echo $_SESSION["strasse"] ?>' required><br>
	</div>
		
	<div class="flex-item-right">
			<label for="hausnummer">Hausnummer:</label><br>
			<input style='width:100%;' type="text" id="hausnummer" name="hausnummer" value='<?php echo $_SESSION["hausnummer"] ?>' pattern="[0-9a-zA-Z\-]+" required><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="plz">Postleitzahl:</label><br>
        <input style='width:100%;' type="text" id="plz" name="plz" value='<?php echo $_SESSION["plz"] ?>' pattern="[0-9]+" minlength="4" maxlength="5" required><br>
	</div>
		
	<div class="flex-item-right">
			<label for="wohnort">Wohnort:</label><br>
			<input style='width:100%;' type="text" id="wohnort" name="wohnort" value='<?php echo $_SESSION["wohnort"] ?>' required><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="telefon1">Telefon / Handy (erste Nummer):</label><br>
			<input style='width:100%;' type="text" id="telefon1" name="telefon1" value='<?php echo $_SESSION["telefon1"] ?>' pattern="0[0-9\-\/]+" minlength="4" required><br>
		</div>
			
		<div class="flex-item-right">
				<label for="telefon2">Telefon / Handy (zweite Nummer):</label><br>
				<input style='width:100%;' type="text" id="telefon2" name="telefon2" value='<?php echo $_SESSION["telefon2"] ?>' pattern="0[0-9\-\/]+" minlength="4"><br>
		</div>
	</div>
	
	<div class="flex-container">
		<div class="flex-item-left">
        <label for="mail">E-Mail:</label><br>
			<input style='width:100%;' type="email" id="mail" name="mail" value='<?php echo $_SESSION["mail"] ?>' required><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label for="schulart">Letzte besuchte Schulart:</label><br>
	<select style='width:100%; font-size: 16;'name='schulart' required='required'>
	<?php
		if ($_SESSION['schulart'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['schulart'];
		$select_st_k = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM schularten WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM schularten ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['langform']."</option>";
				
			}
?>	
			</select><br><br>
		</div>
			
		<div class="flex-item-right">
				<label for="schulname">Name der letzten besuchten Schule:</label><br>
				<?php
				echo "<input style='width:100%;' type='text' id='schulname' name='schulname' value='".$_SESSION['schulname']."' required><br>";

				?>
		</div>
	</div>
		<?php
	if ($_SESSION['schulform'] != "bvj") {
	?>
	<div class="flex-container">
		<div class="flex-item-drei">
			<label for="jahrgang">Zuletzt besuchte Klasse (Jahrgangsstufe):</label><br>
	<select style='width:100%; font-size: 16;'name='jahrgang' required='required'>
	<?php
		if ($_SESSION['jahrgang'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['jahrgang'];
		$select_st_k = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['anzeigeform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM klassenstufen ORDER BY schluessel ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['anzeigeform']."</option>";
				
			}
?>	
			</select><br><br>
		</div>
			
		<div class="flex-item-drei">
			<label for="abschluss">Bis zum Eintritt in die BBS I, (vorraussichtlich) erreichter Abschluss:</label><br>
	<select style='width:100%; font-size: 16;'name='abschluss' required='required'>
	<?php
		if ($_SESSION['abschluss'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['abschluss'];
		$select_st_k = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM vorbildung WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT kurzform, anzeigeform, langform FROM vorbildung ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['langform']."</option>";
				
			}
?>	
			</select><br><br>
		</div>
	</div>	
	
	<?php
	}
	
	?>
</div>
	
	

	
         <input class='btn btn-default btn-sm' id="inputForm" type="submit" name='submit_weiter' value="weiter">
		
		
    </form>
	<?php
		if ($_SESSION['schulform'] == "bs" OR $_SESSION['schulform'] == "bfp") {
		echo "<form id='form_z' method='post' action='./ausbildung.php'>";
		} else {
			echo "<form id='form_z' method='post' action='./index.php'>";
		}
		echo "<input class='btn btn-default btn-sm' id='form_z' type='submit' name='submit_zurueck' value='zurück'>";
		echo "</form>";
	
	?>
<script>
    function togglezuzugField() {
        const geburtslandField = document.getElementById("geburtsland");
        const zuzugField = document.getElementById("zuzugField");
		const herkunftField = document.getElementById("herkunftField");

        if (geburtslandField.value === "DE" || geburtslandField.value === "") {
            zuzugField.classList.add("hidden");
            document.getElementById("zuzug").removeAttribute("required");
			
			herkunftField.classList.add("hidden");
            document.getElementById("herkunft").removeAttribute("required");
        } else {
            zuzugField.classList.remove("hidden");
            document.getElementById("zuzug").setAttribute("required", "required");
			
			herkunftField.classList.remove("hidden");
            document.getElementById("herkunft").setAttribute("required", "required");
        }
    }

    togglezuzugField(); // Initialisierung beim Laden der Seite
</script>

</body>
</html>
<?php
} //Ende nicht submit

include("./fuss.php");

?>
