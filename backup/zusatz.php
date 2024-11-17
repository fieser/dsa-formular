<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");




if (isset($_POST['submit_weiter'])) {
	$_SESSION['bgy_sp1'] = $_POST['bgy_sp1'];
	$_SESSION['bgy_sp2'] = $_POST['bgy_sp2'];
	$_SESSION['bgy_sp3'] = $_POST['bgy_sp3'];
	
	$_SESSION['fs1'] = $_POST['fs1'];
	$_SESSION['fs1_von'] = $_POST['fs1_von'];
	$_SESSION['fs1_bis'] = $_POST['fs1_bis'];
	
	$_SESSION['fs2'] = $_POST['fs2'];
	$_SESSION['fs2_von'] = $_POST['fs2_von'];
	$_SESSION['fs2_bis'] = $_POST['fs2_bis'];
	
	$_SESSION['fs3'] = $_POST['fs3'];
	$_SESSION['fs3_von'] = $_POST['fs3_von'];
	$_SESSION['fs3_bis'] = $_POST['fs3_bis'];



echo "<meta http-equiv='refresh' content=\"0; URL=./senden.php\">";
} else {

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besondere Angaben zur Schulform</title>
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
  flex: 33.33%;
  text-align: left;
}

.flex-item-vier {
  padding: 10px;
  flex: 25%;
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

$select_sf = $db->query("SELECT name FROM schulformen WHERE kuerzel = '$sf_kuerzel'");
		
		foreach($select_sf as $sf) {
		 
		 $sf_name = $sf['name'];
		 
		
		}
    echo "<h1><b>Besondere Angaben zur Schulform</b> <font style='font-size: 0.7em;'> - <i>Anmeldung zur ".$sf_name."</i></font></h1>";
	
?>
	
	
    <form id="inputForm" action="zusatz.php" method="post">
	
	<?php
	//Schulform BGY
	if ($_SESSION['schulform'] == "bgy") {
	?>


<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Wählen Sie Ihre Fachrichtung:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Gewünschte Fachrichtung:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp1' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
				$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_85020%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>

			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Zweitwusch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp2' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
				$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_85020%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>

			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Drittwunsch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp3'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_85020%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
		
			</select><br>
		</div>

	</div>
</div>

<?php
} //Ende SPs BGY



//Schulform BF1
	if ($_SESSION['schulform'] == "bf1") {
	?>


<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Wählen Sie Ihre Fachrichtung:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Gewünschte Fachrichtung:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp1' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82060%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Zweitwusch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp2' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82060%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Drittwunsch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp3'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82060%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
			</select><br>
		</div>

	</div>
</div>

<?php
} //Ende SPs BF1




//Schulform HBF
	if ($_SESSION['schulform'] == "hbf") {
	?>


<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Wählen Sie Ihre Fachrichtung:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Gewünschte Fachrichtung:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp1' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";

		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82049%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
				
			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Zweitwusch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp2'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82049%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Drittwunsch:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp3'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82049%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
			</select><br>
		</div>

	</div>
</div>

<?php
} //Ende SPs HBF



//Schulform FS
	if ($_SESSION['schulform'] == "fs") {
	?>


<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Wählen Sie Ihre Fachrichtung:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Gewünschte Fachrichtung:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp1' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";
		
		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_86060%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>
				
			</select><br>
		</div>

	</div>

</div>

<?php
} //Ende SPs FS


//Schulform BOS1
	if ($_SESSION['schulform'] == "bos1") {
	?>


<div class='box-grau' style='padding-top: 0px; margin-top: 2em;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Wählen Sie Ihre Fachrichtung:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-drei">
			<label>Gewünschte Fachrichtung:</label><br>
		<select style='width:100%; font-size: 16;'name='bgy_sp1' required='required'>
		<?php

			echo "<option value='' disabled selected hidden></option>";

		$select_st = $db->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_87010%' ORDER BY anzeigeform ASC");
		$treffer_st = $select_st->rowCount();
			
			
			foreach($select_st as $st) {
				
				 echo "<option>".$st['anzeigeform']."</option>";
			}
		?>

				
			</select><br>
		</div>

	</div>

</div>

<?php
} //Ende SPs BOS1


if ($_SESSION['schulform'] == "bgy" OR $_SESSION['schulform'] == "bf1" OR $_SESSION['schulform'] == "bf2" OR $_SESSION['schulform'] == "bos1" OR $_SESSION['schulform'] == "bos2" OR $_SESSION['schulform'] == "fs" OR $_SESSION['schulform'] == "hbf") {
?>

<div class='box-grau' style='padding-top: 0px; margin-top: 2em; width: 100%;'>
<p style='padding: 10px; margin-bottom: 0px;'><b>Anerkannter Fremdspracheunterricht:</b></p>

	
	<div class="flex-container">
		<div class="flex-item-left">
		
			<label><b><i>1. Fremdsprache:</i></b></label><br>
		<select style='width:100%; font-size: 16;'name='fs1' required='required'>
		<?php
		if ($_SESSION['fs1'] != "") {
			echo "<option>".$_SESSION['fs1']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option>Englisch</option>
				<option>Französisch</option>
				<option>Spanisch</option>
				<option>Latein</option>
				<option>Italienisch</option>
				<option>Russisch</option>
			</select><br>
		</div>

		
		<div class="flex-item-vier">
			<label>von</label><br>
		<select style='width:100%; font-size: 16;'name='fs1_von' required=''>
		<?php
		if ($_SESSION['fs1_von'] != "") {
			echo "<option>".$_SESSION['fs1_von']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>
		
		<div class="flex-item-vier">
			<label>bis</label><br>
		<select style='width:100%; font-size: 16;'name='fs1_bis' required=''>
		<?php
		if ($_SESSION['fs1_bis'] != "") {
			echo "<option>".$_SESSION['fs1_bis']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>

	</div>
	
	<div class="flex-container">
		<div class="flex-item-left">
		
			<label><b><i>2. Fremdsprache:</b></i></label><br>
		<select style='width:100%; font-size: 16;'name='fs2'>
		<?php
		if ($_SESSION['fs2'] != "") {
			echo "<option>".$_SESSION['fs2']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Englisch</option>
				<option>Französisch</option>
				<option>Spanisch</option>
				<option>Latein</option>
				<option>Italienisch</option>
				<option>Russisch</option>
			</select><br>
		</div>

		
		<div class="flex-item-vier">
			<label>von</label><br>
		<select style='width:100%; font-size: 16;'name='fs2_von'>
		<?php
		if ($_SESSION['fs2_von'] != "") {
			echo "<option>".$_SESSION['fs2_von']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>
		
		<div class="flex-item-vier">
			<label>bis</label><br>
		<select style='width:100%; font-size: 16;'name='fs2_bis' >
		<?php
		if ($_SESSION['fs2_bis'] != "") {
			echo "<option>".$_SESSION['fs2_bis']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>

	</div>
	
	
	<div class="flex-container">
		<div class="flex-item-left">
		
			<label><b><i>3. Fremdsprache:</b></i></label><br>
		<select style='width:100%; font-size: 16;'name='fs3' >
		<?php
		if ($_SESSION['fs3'] != "") {
			echo "<option>".$_SESSION['fs3']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Englisch</option>
				<option>Französisch</option>
				<option>Spanisch</option>
				<option>Latein</option>
				<option>Italienisch</option>
				<option>Russisch</option>
			</select><br>
		</div>

		
		<div class="flex-item-vier">
			<label>von</label><br>
		<select style='width:100%; font-size: 16;'name='fs3_von'>
		<?php
		if ($_SESSION['fs3_von'] != "") {
			echo "<option>".$_SESSION['fs3_von']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>
		
		<div class="flex-item-vier">
			<label>bis</label><br>
		<select style='width:100%; font-size: 16;'name='fs3_bis'>
		<?php
		if ($_SESSION['fs3_bis'] != "") {
			echo "<option>".$_SESSION['fs3_bis']."</option>";
		} else {
			echo "<option value='' disabled selected hidden></option>";
		}
		?>
				<option></option>
				<option>Klasse 5</option>
				<option>Klasse 6</option>
				<option>Klasse 7</option>
				<option>Klasse 8</option>
				<option>Klasse 9</option>
				<option>Klasse 10</option>
				<option>Klasse 11</option>
				<option>Klasse 12</option>
				<option>Klasse 13</option>
			</select><br>
		</div>

	</div>
	
</div>
		<?php
} //Ende Fremdsprachen

	?>

	
	
	
	
	
	
	

	

         <input class='btn btn-default btn-sm' id="inputForm" type="submit" name='submit_weiter' value="weiter">
		
		
    </form>
	<?php
	if ($_SESSION['sorge1_nachname'] == "") {
		echo "<form id='form_z' method='post' action='./bewerberdaten.php'>";
	} else {
		echo "<form id='form_z' method='post' action='./eltern.php'>";
	}
	?>
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
