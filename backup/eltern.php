<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");



if (isset($_POST['sorge1_nachname'])) {
	$_SESSION['sorge1_vorname'] = $_POST['sorge1_vorname'];
	$_SESSION['sorge1_nachname'] = $_POST['sorge1_nachname'];
	$_SESSION['sorge1_anrede'] = $_POST['sorge1_anrede'];
	$_SESSION['sorge1_art'] = $_POST['sorge1_art'];
	$_SESSION['sorge1_strasse'] = $_POST['sorge1_strasse'];
	$_SESSION['sorge1_hausnummer'] = $_POST['sorge1_hausnummer'];
	$_SESSION['sorge1_plz'] = $_POST['sorge1_plz'];
	$_SESSION['sorge1_wohnort'] = $_POST['sorge1_wohnort'];
	$_SESSION['sorge1_telefon1'] = $_POST['sorge1_telefon1'];
	$_SESSION['sorge1_telefon2'] = $_POST['sorge1_telefon2'];
	$_SESSION['sorge1_mail'] = $_POST['sorge1_mail'];
	
	$_SESSION['sorge2_vorname'] = $_POST['sorge2_vorname'];
	$_SESSION['sorge2_nachname'] = $_POST['sorge2_nachname'];
	$_SESSION['sorge2_anrede'] = $_POST['sorge2_anrede'];
	$_SESSION['sorge2_art'] = $_POST['sorge2_art'];
	$_SESSION['sorge2_strasse'] = $_POST['sorge2_strasse'];
	$_SESSION['sorge2_hausnummer'] = $_POST['sorge2_hausnummer'];
	$_SESSION['sorge2_plz'] = $_POST['sorge2_plz'];
	$_SESSION['sorge2_wohnort'] = $_POST['sorge2_wohnort'];
	$_SESSION['sorge2_telefon1'] = $_POST['sorge2_telefon1'];
	$_SESSION['sorge2_telefon2'] = $_POST['sorge2_telefon2'];
	$_SESSION['sorge2_mail'] = $_POST['sorge2_mail'];
	
	$_SESSION['weitere'] = $_POST['weitere'];

	if ($_SESSION['schulform'] == "bgy" OR $_SESSION['schulform'] == "bf1" OR $_SESSION['schulform'] == "bf2" OR $_SESSION['schulform'] == "bos1" OR $_SESSION['schulform'] == "bos2" OR $_SESSION['schulform'] == "fs" OR $_SESSION['schulform'] == "hbf") {
		echo "<meta http-equiv='refresh' content=\"0; URL=./zusatz.php\">";
	} else {
		echo "<meta http-equiv='refresh' content=\"0; URL=./senden.php\">";
	}
	
} else {

//Schüler bereits volljährig?
if (strtotime($_SESSION['geburtsdatum']) < (time() - 18*365*24*3600)) {
	$_SESSION['volljaehrig'] = 1;
} else {
	$_SESSION['volljaehrig'] = 0;
}


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorgeberechtigte</title>
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



<?php
		//Anzeige Schulform vorbereiten:
		$sf_kuerzel = $_SESSION['schulform'];

		$select_sf = $db->query("SELECT name FROM schulformen WHERE kuerzel = '$sf_kuerzel'");
		
		foreach($select_sf as $sf) {
		 
		 $sf_name = $sf['name'];
		 
		
		}
		
		
		
		
	if ($_SESSION['volljaehrig'] == 0) {
		echo "<h1><b>Kontaktdaten der Sorgeberechtigten</b> <font style='font-size: 0.7em;'> - <i>Anmeldung zur ".$sf_name."</i></font></h1>";
		$required = "required";
		
		
		//Vorbelegung der Adressfelder:
		if ($vorbelegen_sorge1 == 1) {
			

	$_SESSION['sorge1_strasse'] = $_SESSION['strasse'];
	$_SESSION['sorge1_hausnummer'] = $_SESSION['hausnummer'];
	$_SESSION['sorge1_plz'] = $_SESSION['plz'];
	$_SESSION['sorge1_wohnort'] = $_SESSION['wohnort'];
	$_SESSION['sorge1_telefon1'] = $_SESSION['telefon1'];

			
		}
		
		
		
		
	} else {
		echo "<h1><b>Kontaktdaten zusätzlicher Ansprechpersonen</b> <font style='font-size: 0.7em;'> - <i>Anmeldung zur ".$sf_name."</i></font></h1>";
		echo "<i>(freiwillige Angabe)</i>";
		$required = "";
	}
?>	
	
    <form id="inputForm" action="eltern.php" method="post">
<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Erste Ansprechperson</b></p>


<div class="flex-container">
	<div class="flex-item-drei">
        <label>Anrede:</label><br>
		<?php
		if ($required != "") { 
			echo "<select style='width:100%; font-size: 16;'name='sorge1_anrede' required='<?php echo $required ?>'>";
		} else {
			echo "<select style='width:100%; font-size: 16;'name='sorge1_anrede'>";
		}

	if ($_SESSION['sorge1_anrede'] != "") {
		echo "<option>".$_SESSION['sorge1_anrede']."</option>";
	} else {
		echo "<option value='' disabled selected hidden></option>";
	}
	?>
            <option>Frau</option>
            <option>Herr</option>
            <option>keine</option>
        </select><br>
	</div>
	
		<div class="flex-item-drei">
        <label>Art der Ansprechperson:</label><br>
	<?php
		if ($required != "") { 
			echo "<select style='width:100%; font-size: 16;'name='sorge1_art' required='<?php echo $required ?>'>";
		} else {
			echo "<select style='width:100%; font-size: 16;'name='sorge1_art'>";
		}

		if ($_SESSION['sorge1_art'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['sorge1_art'];
		$select_st_k = $db->query("SELECT kurzform, anzeigeform FROM sorge WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['anzeigeform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db->query("SELECT kurzform, anzeigeform FROM sorge ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['anzeigeform']."</option>";
				
			}
?>	
        </select><br>
	</div>	
</div>
<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge1_vorname">Vorname:</label><br>
        <input style='width:100%;' type="text" id="sorge1_vorname" name="sorge1_vorname" value='<?php echo $_SESSION["sorge1_vorname"] ?>' <?php echo $required ?>><br>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge1_nachname">Nachname:</label><br>
			<input style='width:100%;' type="text" id="sorge1_nachname" name="sorge1_nachname" value='<?php echo $_SESSION["sorge1_nachname"] ?>' <?php echo $required ?>><br>
	</div>
</div>
	
	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge1_strasse">Straße:</label><br>
        <input style='width:100%;' type="text" id="sorge1_strasse" name="sorge1_strasse" value='<?php echo $_SESSION["sorge1_strasse"] ?>' pattern="[a-zA-Zöäüß\-\.\s]+" <?php echo $required ?>><br>
		<?php
		If ($vorbelegen_sorge1 == 1 AND $_SESSION['volljaehrig'] == 0) {
			echo "<i style='color: red;'><small><b>Prüfen Sie bitte die Richtigkeit der vorausgefüllten Daten!</b></small></i>";
		}
		?>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge1_hausnummer">Hausnummer:</label><br>
			<input style='width:100%;' type="text" id="sorge1_hausnummer" name="sorge1_hausnummer" value='<?php echo $_SESSION["sorge1_hausnummer"] ?>' pattern="[0-9a-zA-Z\-]+" <?php echo $required ?>><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge1_plz">Postleitzahl:</label><br>
        <input style='width:100%;' type="text" id="sorge1_plz" name="sorge1_plz" value='<?php echo $_SESSION["sorge1_plz"] ?>' pattern="[0-9]+" minlength="5" maxlength="5" <?php echo $required ?>><br>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge1_wohnort">Wohnort:</label><br>
			<input style='width:100%;' type="text" id="sorge1_wohnort" name="sorge1_wohnort" value='<?php echo $_SESSION["sorge1_wohnort"] ?>' <?php echo $required ?>><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge1_telefon1">Telefon / Handy (erste Nummer):</label><br>
			<input style='width:100%;' type="text" id="sorge1_telefon1" name="sorge1_telefon1" value='<?php echo $_SESSION["sorge1_telefon1"] ?>' pattern="0[0-9\-\/]+" minlength="4" <?php echo $required ?>><br>
		</div>
			
		<div class="flex-item-right">
				<label for="sorge1_telefon2">Telefon / Handy (zweite Nummer):</label><br>
				<input style='width:100%;' type="text" id="sorge1_telefon2" name="sorge1_telefon2" value='<?php echo $_SESSION["sorge1_telefon2"] ?>' pattern="0[0-9\-\/]+" minlength="4"><br>
		</div>
	</div>
	
	<div class="flex-container">
		<div class="flex-item-left">
        <label for="sorge1_mail">E-Mail:</label><br>
			<input style='width:100%;' type="email" id="sorge1_mail" name="sorge1_mail" value='<?php echo $_SESSION["sorge1_mail"] ?>' <?php echo $required ?>><br>
		</div>

	</div>
</div>


	<div class='box-grau'>
			<div class="flex-item-drei">
			<label for='weitere'>Weitere sorgeberechtigte Person?</label><br>
		<?php	
		if ($required != "") {
		echo "<select style='width:4em; font-size: 16;'name='weitere' id='weitere' required='<?php echo $required ?>' onchange='togglezuzugField()'>";
		} else {
			echo "<select style='width:4em; font-size: 16;'name='weitere' id='weitere' onchange='togglezuzugField()'>";
		}
		
		
	if ($_SESSION['weitere'] != "") {
		if ($_SESSION['weitere'] == "0") {
		echo "<option value='0'>nein</option></option>";
		}
		if ($_SESSION['weitere'] == "1") {
		echo "<option value='1'>ja</option></option>";
		}
	} else {
		echo "<option value='' disabled selected hidden></option>";
	}
	?>
				<option value="0">nein</option>
				<option value="1">ja</option>
				
			</select><br>
		</div>
	</div>
	

	
	
	
	
	
	
	
<div class='box-grau' for="zuzug" id='zuzugField' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Zweite Ansprechperson</b></p>


<div class="flex-container">
	<div class="flex-item-drei">
        <label>Anrede:</label><br>
	<select style='width:100%; font-size: 16;'name='sorge2_anrede'>
	<?php
	if ($_SESSION['sorge2_anrede'] != "") {
		echo "<option>".$_SESSION['sorge2_anrede']."</option>";
	} else {
		echo "<option value='' disabled selected hidden></option>";
	}
	?>
            <option>Frau</option>
            <option>Herr</option>
            <option>keine</option>
        </select><br>
	</div>
	
		<div class="flex-item-drei">
        <label>Art der Ansprechperson:</label><br>
	<select style='width:100%; font-size: 16;'name='sorge2_art' >
	<?php
		if ($_SESSION['sorge2_art'] != "") {
			$kuerzel_staatsangehoerigkeit = $_SESSION['sorge2_art'];
		$select_st_k = $db->query("SELECT kurzform, anzeigeform FROM sorge WHERE kurzform LIKE '$kuerzel_staatsangehoerigkeit'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['kurzform']."'>".$st_k['anzeigeform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db->query("SELECT kurzform, anzeigeform FROM sorge ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['kurzform']."'>".$st['anzeigeform']."</option>";
				
			}
?>	
        </select><br>
	</div>	
</div>
<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge2_vorname">Vorname:</label><br>
        <input style='width:100%;' type="text" id="sorge2_vorname" name="sorge2_vorname" value='<?php echo $_SESSION["sorge2_vorname"] ?>' ><br>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge2_nachname">Nachname:</label><br>
			<input style='width:100%;' type="text" id="sorge2_nachname" name="sorge2_nachname" value='<?php echo $_SESSION["sorge2_nachname"] ?>' ><br>
	</div>
</div>

	
	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge2_strasse">Straße:</label><br>
        <input style='width:100%;' type="text" id="sorge2_strasse" name="sorge2_strasse" value='<?php echo $_SESSION["sorge2_strasse"] ?>' pattern="[a-zA-Zöäüß\-\.\s]+" ><br>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge2_hausnummer">Hausnummer:</label><br>
			<input style='width:100%;' type="text" id="sorge2_hausnummer" name="sorge2_hausnummer" value='<?php echo $_SESSION["sorge2_hausnummer"] ?>' pattern="[0-9a-zA-Z\-]+" ><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge2_plz">Postleitzahl:</label><br>
        <input style='width:100%;' type="text" id="sorge2_plz" name="sorge2_plz" value='<?php echo $_SESSION["sorge2_plz"] ?>' pattern="[0-9]+" minlength="5" maxlength="5" ><br>
	</div>
		
	<div class="flex-item-right">
			<label for="sorge2_wohnort">Wohnort:</label><br>
			<input style='width:100%;' type="text" id="sorge2_wohnort" name="sorge2_wohnort" value='<?php echo $_SESSION["sorge2_wohnort"] ?>' ><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left">
        <label for="sorge2_telefon1">Telefon / Handy (erste Nummer):</label><br>
			<input style='width:100%;' type="text" id="sorge2_telefon1" name="sorge2_telefon1" value='<?php echo $_SESSION["sorge2_telefon1"] ?>' pattern="0[0-9\-\/]+" minlength="4" ><br>
		</div>
			
		<div class="flex-item-right">
				<label for="sorge2_telefon2">Telefon / Handy (zweite Nummer):</label><br>
				<input style='width:100%;' type="text" id="sorge2_telefon2" name="sorge2_telefon2" value='<?php echo $_SESSION["sorge2_telefon2"] ?>' pattern="0[0-9\-\/]+" minlength="4"><br>
		</div>
	</div>
	
	<div class="flex-container">
		<div class="flex-item-left">
        <label for="sorge2_mail">E-Mail:</label><br>
			<input style='width:100%;' type="email" id="sorge2_mail" name="sorge2_mail" value='<?php echo $_SESSION["sorge2_mail"] ?>' ><br>
		</div>

	</div>
	

</div>	
	

         <input class='btn btn-default btn-sm' id="inputForm" type="submit" name='submit_weiter' value="weiter">
		
		
    </form>
		<form id='form_z' method='post' action='./bewerberdaten.php'>
	<input class='btn btn-default btn-sm' method='post' action='./index.php' id='form_z' type="submit" name='submit_zurueck' value="zurück">
	</form>
<script>
    function togglezuzugField() {
        const weitereField = document.getElementById("weitere");
        const zuzugField = document.getElementById("zuzugField");

        if (weitereField.value === "0" || weitereField.value === "") {
            zuzugField.classList.add("hidden");
            document.getElementById("zuzug").removeAttribute("required");
        } else {
            zuzugField.classList.remove("hidden");
        }
    }

    togglezuzugField(); // Initialisierung beim Laden der Seite
</script>

</body>
</html>
<?php
} //Ende kein submit

include("./fuss.php");

?>
