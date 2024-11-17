<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");





if (isset($_GET['sf'])) {
$_SESSION['schulform'] = $_GET['sf'];
}

if (isset($_POST['beruf'])) {
	$_SESSION['dauer'] = $_POST['dauer'];
	$_SESSION['beginn'] = $_POST['beginn'];
	$_SESSION['ende'] = $_POST['ende'];
	$_SESSION['beruf'] = $_POST['beruf'];
	$_SESSION['beruf2'] = $_POST['beruf2'];
	$_SESSION['betrieb'] = $_POST['betrieb'];
	$_SESSION['betrieb2'] = $_POST['betrieb2'];
	$_SESSION['betrieb_plz'] = $_POST['betrieb_plz'];
	$_SESSION['betrieb_ort'] = $_POST['betrieb_ort'];
	$_SESSION['betrieb_strasse'] = $_POST['betrieb_strasse'];
	$_SESSION['betrieb_hausnummer'] = $_POST['betrieb_hausnummer'];
	$_SESSION['betrieb_telefon'] = $_POST['betrieb_telefon'];
	$_SESSION['betrieb_mail'] = $_POST['betrieb_mail'];
	$_SESSION['ausbilder_nachname'] = $_POST['ausbilder_nachname'];
	$_SESSION['ausbilder_vorname'] = $_POST['ausbilder_vorname'];
	$_SESSION['ausbilder_telefon'] = $_POST['ausbilder_telefon'];
	$_SESSION['ausbilder_telefon2'] = $_POST['ausbilder_telefon2'];
	$_SESSION['ausbilder_mail'] = $_POST['ausbilder_email'];
	
	//Ermitteln der Berufsbezeichnung:
		$beruf = $_POST['beruf'];
		$select_ber = $db_temp->query("SELECT anzeigeform FROM berufe WHERE schluessel = '$beruf'");	
		foreach($select_ber as $ber) {
		$_SESSION['beruf_anz'] = $ber['anzeigeform'];
		}

echo "<meta http-equiv='refresh' content=\"0; URL=./bewerberdaten.php\">";
} else {




?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berufsdaten</title>
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
if ($_SESSION['schulform'] == "bs") {
    echo "<h1>Angaben zum Ausbildungsvertrag</h1>";
} else {
	echo "<h1>Angaben zur Ausbildung</h1>";
}
?>
    <form id="inputForm" action="ausbildung.php" method="post">
<div class='box-grau'>	

		

<div class="flex-container">

<?php
		if ($_SESSION['schulform'] == "bs") {
			?>

	<div class="flex-item-drei">
        <label>Ausbildungsdauer:</label><br>
	<select style='width:100%; font-size: 16;'name='dauer' required='required'>
	<?php
		if ($_SESSION['dauer'] != "") {
			$kuerzel_dauer = $_SESSION['dauer'];
		$select_st_k = $db_temp->query("SELECT anzeigeform, langform FROM dauer WHERE anzeigeform LIKE '$kuerzel_dauer'");
		foreach($select_st_k as $st_k) {
		echo "<option value='".$st_k['anzeigeform']."'>".$st_k['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
	
			$select_st = $db_temp->query("SELECT anzeigeform, langform FROM dauer ORDER BY langform ASC");
			$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option value='".$st['anzeigeform']."'>".$st['langform']."</option>";
				
			}
?>	
        </select><br><br>
	</div>
<?php
		}

		if ($_SESSION['schulform'] == "bs") {
			?>
	<div class="flex-item-drei">
        <label for="beginn">Beginn der Ausbildung:</label><br>
        <input style='width:100%;' type="date" id="beginn" name="beginn" value='<?php echo $_SESSION["beginn"] ?>' required><br>
	</div>
	
		<div class="flex-item-drei">
        <label for="ende">Ende der Ausbildung <small>(gemäß Ausbildungsvertrag)</small>:</label><br>
        <input style='width:100%;' type="date" id="ende" name="ende" value='<?php echo $_SESSION["ende"] ?>' required><br>
		</div>
		<?php
}
		?>
</div>


			
<div class="flex-container">

<?php
		if ($_SESSION['schulform'] == "bs") {
			?>
	
	<div class="flex-item-drei">
		<label for="beruf">Ausbildungsberuf:</label><br>
        <select style='width:100%; font-size: 16;' id="beruf" name="beruf" required='required' onchange="togglezuzugField()">
		<?php
		$_SESSION['beruf'] = "";
		if ($_SESSION['beruf'] != "") {
			$schluessel_beruf = $_SESSION['beruf'];
		$select_bu_s = $db_temp->query("SELECT schluessel, langform FROM berufe WHERE schluessel LIKE '$schluessel_beruf'");
		foreach($select_bu_s as $bu_s) {
		echo "<option value='".$bu_s['schluessel']."'>".$bu_s['langform']."</option>";
		}
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
	
            <option value="sonstiger">sonstiger</option>
			
<?php
		echo "<option value='' disabled>-----------------------</option>";
		
					//Nur an der Schule vorhandene Berufe anzeigen:
					$select_bes = $db_temp->query("SELECT langform, schluessel FROM berufe_angebot ORDER BY langform ASC");
					$treffer_bes = $select_bes->rowCount();

			foreach ($select_bes as $bes) {
				if ($bes['langform'] != "" AND $bes['schluessel'] != "99000100-BJ" AND $treffer_bes != 0) {
				 echo "<option value='".$bes['schluessel']."'>".$bes['langform']."</option>";
				}
			}
?>		
        </select><br><br>
		</div>
		
	<?php
		}  else {	 //ENDE Schulform BS
		echo "<input type='hidden' id='beruf' name='beruf'>";
		}
		?>	
		
		
</div>



<div class="flex-container">
		
		<div class="flex-item-drei"  id="zuzugField">
		<?php
		if ($_SESSION['schulform'] == "bs") {
			?>
        <label for="zuzug">Sonstiger Ausbildungsberuf:</label><br>
		
        <input style='width:100%;' type="text" id="zuzug" name="beruf2" value='<?php echo $_SESSION["beruf2"] ?>' placeholder='Formulieren Sie hier möglichst genau die Berufsbezichnung!'><br>
		
		<input type='hidden' id='zuzug' name='beruf2'>
		<?php
		} else {	 //ENDE Schulform BS
		echo "<input type='hidden' id='zuzug' name='beruf2'>";
		}
?> 
		</div>

 </div>	


 
 <div class="flex-container">
	
		
			<div class="flex-item-drei">
		<label for="betrieb">Ausbildungsbetrieb:</label><br>
<select style='width:100%; font-size: 16;' id="betrieb" name="betrieb" required='required'>
    <!-- Der Inhalt dieses Felds wird durch die AJAX-Anfrage ersetzt -->
</select>

		</div>
</div>

<div class="flex-container">
		
		<div class="flex-item-drei"  id="betrieb2Field">
        <label for="betrieb2">Name Ausbildungsbetrieb:</label><br>
        <input style='width:100%;' type="text" id="betrieb2" name="betrieb2" value='<?php echo $_SESSION["betrieb2"] ?>'><br>
		</div>

 </div>	

	
	<div class="flex-container">
	
	<div class="flex-item-left" id="betrieb3Field">
        <label for="betrieb_strasse">Anschrift Betrieb:</label><br>
        <input style='width:100%;' type="text" id="betrieb_strasse" name="betrieb_strasse" value='<?php echo $_SESSION["betrieb_strasse"] ?>' pattern="[a-zA-Zöäüß\-\.\s]+"><br>
	</div>
		
	<div class="flex-item-right" id="betrieb4Field">
			<label for="betrieb_hausnummer">Hausnummer:</label><br>
			<input style='width:100%;' type="text" id="betrieb_hausnummer" name="betrieb_hausnummer" value='<?php echo $_SESSION["betrieb_hausnummer"] ?>' pattern="[0-9a-zA-Z\-]+"><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left" id="betrieb5Field">
        <label for="betrieb_plz">Postleitzahl:</label><br>
        <input style='width:100%;' type="text" id="betrieb_plz" name="betrieb_plz" value='<?php echo $_SESSION["betrieb_plz"] ?>' pattern="[0-9]+" minlength="5" maxlength="5"><br>
	</div>
		
	<div class="flex-item-right" id="betrieb6Field">
			<label for="betrieb_ort">Ort:</label><br>
			<input style='width:100%;' type="text" id="betrieb_ort" name="betrieb_ort" value='<?php echo $_SESSION["betrieb_ort"] ?>'><br>
	</div>
</div>

	<div class="flex-container">
	
	<div class="flex-item-left" id="betrieb7Field">
        <label for="ausbilder_nachname">Nachname (Ausbilder/-in):</label><br>
			<input style='width:100%;' type="text" id="ausbilder_nachname" name="ausbilder_nachname" value='<?php echo $_SESSION["ausbilder_nachname"] ?>' ><br>
		</div>
			
		<div class="flex-item-right" id="betrieb8Field">
				<label for="ausbilder_vorname">Vorname (Ausbilder/-in):</label><br>
				<input style='width:100%;' type="text" id="ausbilder_vorname" name="ausbilder_vorname" value='<?php echo $_SESSION["ausbilder_vorname"] ?>' ><br>
		</div>
	</div>

	<div class="flex-container">
	
	<div class="flex-item-left" id="betrieb9Field">
        <label for="betrieb_telefon">Telefon / Handy (Betrieb):</label><br>
			<input style='width:100%;' type="text" id="betrieb_telefon" name="betrieb_telefon" value='<?php echo $_SESSION["betrieb_telefon"] ?>' pattern="0[0-9\-\/]+" minlength="4"><br>
		</div>
			
		<div class="flex-item-right" id="betrieb10Field">
				<label for="ausbilder_telefon">Telefon / Handy (Ausbilder/-in):</label><br>
				<input style='width:100%;' type="text" id="ausbilder_telefon" name="ausbilder_telefon" value='<?php echo $_SESSION["ausbilder_telefon"] ?>' pattern="0[0-9\-\/]+" minlength="4"><br>
		</div>
	</div>
	
	<div class="flex-container">
		<div class="flex-item-left" id="betrieb11Field">
        <label for="betrieb_mail">E-Mail Betrieb:</label><br>
			<input style='width:100%;' type="email" id="betrieb_mail" name="betrieb_mail" value='<?php echo $_SESSION["betrieb_mail"] ?>'><br>
		</div>
		<div class="flex-item-right" id="betrieb12Field">
		 <label for="ausbilder_mail">E-Mail Ausbilder/-in:</label><br>
			<input style='width:100%;' type="email" id="ausbilder_mail" name="ausbilder_mail" value='<?php echo $_SESSION["ausbilder_mail"] ?>'><br>
		</div>

	</div>
	
	
</div>
	
	

	
         <input class='btn btn-default btn-sm' id="inputForm" type="submit" name='submit_weiter' value="weiter">
		
		
    </form>
			<form id='form_z' method='post' action='./index.php'>
	<input class='btn btn-default btn-sm' method='post' action='./index.php' id='form_z' type="submit" name='submit_zurueck' value="zurück">
	</form>
	
	
<script>
function setupBetriebChangeListener() {
    document.getElementById('betrieb').addEventListener('change', function() {
        // Überprüfung, ob der Wert 'sonstiger' ist und Ein-/Ausblenden der Felder
        togglebetriebField();
    });
}

function togglebetriebField() {
    var betriebValue = document.getElementById('betrieb').value;
    // Logik zum Ein-/Ausblenden der zusätzlichen Felder
    if (betriebValue === 'sonstiger') {
        // Felder einblenden
        document.getElementById('betrieb2Field').style.display = 'block';
        // Stelle sicher, dass alle weiteren Felder ebenfalls ein-/ausgeblendet werden
    } else {
        // Felder ausblenden
        document.getElementById('betrieb2Field').style.display = 'none';
    }
}

document.getElementById('beruf').addEventListener('change', function() {
    var berufSchluessel = this.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('betrieb').innerHTML = this.responseText;
            setupBetriebChangeListener(); // Listener neu setzen
            togglebetriebField(); // Direkt ausführen, falls 'sonstiger' bereits ausgewählt ist
        }
    };
    xhttp.open("GET", "getBetriebe.php?berufSchluessel=" + berufSchluessel, true);
    xhttp.send();
});

// Initialer Aufruf der Funktion zum Setzen des Event-Listeners
setupBetriebChangeListener();

</script>


	
	
	

<script>
    function togglezuzugField() {
        const geburtslandField = document.getElementById("beruf");
        const zuzugField = document.getElementById("zuzugField");

        if (geburtslandField.value !== "sonstiger" || geburtslandField.value === "") {
            zuzugField.classList.add("hidden");
            document.getElementById("zuzug").removeAttribute("required");
        } else {
            zuzugField.classList.remove("hidden");
            document.getElementById("zuzug").setAttribute("required", "required");
        }
    }

    function togglebetriebField() {
        const betriebField = document.getElementById("betrieb");
        const betrieb2Field = document.getElementById("betrieb2Field");
		const betrieb3Field = document.getElementById("betrieb3Field");
		const betrieb4Field = document.getElementById("betrieb4Field");
		const betrieb5Field = document.getElementById("betrieb5Field");
		const betrieb6Field = document.getElementById("betrieb6Field");
		const betrieb7Field = document.getElementById("betrieb7Field");
		const betrieb8Field = document.getElementById("betrieb8Field");
		const betrieb9Field = document.getElementById("betrieb9Field");
		const betrieb10Field = document.getElementById("betrieb10Field");
		const betrieb11Field = document.getElementById("betrieb11Field");
		const betrieb12Field = document.getElementById("betrieb12Field");

        if (betriebField.value !== "sonstiger" || betriebField.value === "") {
            betrieb2Field.classList.add("hidden");
            document.getElementById("betrieb2").removeAttribute("required");
			
			betrieb3Field.classList.add("hidden");
            document.getElementById("betrieb_strasse").removeAttribute("required");
			
			betrieb4Field.classList.add("hidden");
            document.getElementById("betrieb_hausnummer").removeAttribute("required");
			
			betrieb5Field.classList.add("hidden");
            document.getElementById("betrieb_plz").removeAttribute("required");
			
			betrieb6Field.classList.add("hidden");
            document.getElementById("betrieb_ort").removeAttribute("required");
			
			betrieb7Field.classList.add("hidden");
            document.getElementById("ausbilder_nachname").removeAttribute("required");
			
			betrieb8Field.classList.add("hidden");
            document.getElementById("ausbilder_vorname").removeAttribute("required");
			
			betrieb9Field.classList.add("hidden");
            document.getElementById("betrieb_telefon").removeAttribute("required");
			
			betrieb10Field.classList.add("hidden");
            document.getElementById("ausbilder_telefon").removeAttribute("required");
			
			betrieb11Field.classList.add("hidden");
            document.getElementById("betrieb_mail").removeAttribute("required");
			
			betrieb12Field.classList.add("hidden");
            document.getElementById("ausbilder_mail").removeAttribute("required");
        } else {
            betrieb2Field.classList.remove("hidden");
            document.getElementById("betrieb2").setAttribute("required", "required");
			
			betrieb3Field.classList.remove("hidden");
            document.getElementById("betrieb_strasse").setAttribute("required", "required");
			
			betrieb4Field.classList.remove("hidden");
            document.getElementById("betrieb_hausnummer").setAttribute("required", "required");
			
			betrieb5Field.classList.remove("hidden");
            document.getElementById("betrieb_plz").setAttribute("required", "required");
			
			betrieb6Field.classList.remove("hidden");
            document.getElementById("betrieb_ort").setAttribute("required", "required");
			
			betrieb7Field.classList.remove("hidden");
            document.getElementById("ausbilder_nachname").setAttribute("required", "required");
			
			betrieb8Field.classList.remove("hidden");
            document.getElementById("ausbilder_vorname").setAttribute("required", "required");
			
			betrieb9Field.classList.remove("hidden");
            document.getElementById("betrieb_telefon").setAttribute("required", "required");
			
			betrieb10Field.classList.remove("hidden");
            
			
			betrieb11Field.classList.remove("hidden");
            document.getElementById("betrieb_mail").setAttribute("required", "required");
			
			betrieb12Field.classList.remove("hidden");
            
        }
    }
    togglezuzugField(); // Initialisierung beim Laden der Seite
	togglebetriebField(); // Initialisierung beim Laden der Seite
</script>

</body>
</html>
<?php
} //Ende kein submit

include("./fuss.php");

?>
