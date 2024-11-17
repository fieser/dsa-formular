<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');


include("./login_inc.php");
@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");




// Ist Nutzer angemeldet?
if (isset($_SESSION['username'])) {
	
	// Admin- und Sekretariats-Rechte:
	include "./rechte.php";

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
    <h1 style='margin-bottom: 2em;'>ToDo-Liste</h1>

<?php
if (!isset($_GET['id']) AND !isset($_POST['id'])) {
echo "<form method='post' action='./index.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Menü' />";
echo "</form>";
} else {
echo "<table><tr>";
echo "<td>";
echo "<form method='post' action='./liste.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='zurück' />";
echo "</form>";
echo "</td>";
echo "<td width='20px'>";
echo "</td>";
echo "<td>";
echo "<form method='post' action='./todo.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='alle ToDos' />";
echo "</form>";
echo "</td>";
echo "</table></tr>";

$id = $_GET['id'];
	if ($_POST['id'] != "") {
		$id = $_POST['id'];
	}
}

if ($_POST['erledigt']) {
	$id_erledigt = $_POST['erledigt'];
}

//Auswertung post erledigt
	if (isset($_POST['erledigt'])) {
		$id_erledigt = $_POST['erledigt'];
					if ($db->exec("UPDATE `fehler`
									   SET
										`erledigt` = '1' WHERE `id` = '$id_erledigt'")) { 	
										}
	}


echo "<h2>Abweichungen zwischen Anmeldungen und edoo.sys</h2>";
$select_fe = $db->query("SELECT * FROM fehler WHERE erledigt != '1' AND id_bewerberdaten LIKE '%$id%'");	
$treffer_fe = $select_fe->rowCount();

if ($treffer_fe = 0) {
	echo "Keine gefunden - Es gib nichts zu tun!";
} else {
	
	foreach($select_fe as $fe) {
		
		$fe_id_bewerberdaten = $fe['id_bewerberdaten'];
		$fe_id = $fe['id'];
		
		$select_be = $db->query("SELECT * FROM dsa_bewerberdaten WHERE id = '$fe_id_bewerberdaten'");	
		$treffer_be = $select_be->rowCount();

		foreach($select_be as $be) {
			$be_nachname = $be['nachname'];
			$be_vorname = $be['vorname'];
		}
		
		
		echo "<table width='100%'><tr>";
			echo "<td width='60%'>";
			echo "<div class='box-grau' bgcolor='' onmouseover=\"this.style.backgroundColor='d3d3d3'\" onclick=\"window.open('./datenblatt.php?id=".$fe_id_bewerberdaten."&back=todo','Fenster')\" onmouseout=\"this.style.backgroundColor=''\">";
			echo $be_nachname.", ".$be_vorname.":<br>";
			if ($fe['feld_edoo'] != "" AND $fe['feld_dsa'] != "") {
			echo $fe['feldname'].": <b><font color='red'>".$fe['feld_edoo']."</font></b> ungleich <b><font color='green'>".$fe['feld_dsa']."</font></b>";
			} else {
			echo $fe['hinweis'];
			}
		echo "</div>";
		echo "</td>";
			
		echo "<td width='40px'>";
		echo "</td>";
		
		echo "<td style='align: right;'>";
			echo "<form method='post' action='./todo.php'>";
				echo "<input type='hidden' name='erledigt' value='$fe_id'>";
			if (isset($id)) {
				echo "<input type='hidden' name='erledigt' value='$fe_id'>";
				echo "<input type='hidden' name='id' value='$id'>";
			}
			echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='submit_erledigt' value='erledigt' />";
			echo "</form>";
			echo "</td>";
		echo "</tr></table>";
		
		
	}
}
	
if (!isset($_GET['id'])) {
echo "<form method='post' action='./index.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Menü' />";
echo "</form>";
} else {
echo "<table><tr>";
echo "<td>";
echo "<form method='post' action='./liste.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='zurück' />";
echo "</form>";
echo "</td>";
echo "<td width='20px'>";
echo "</td>";
echo "<td>";
echo "<form method='post' action='./todo.php'>";
echo "<input style='width: 10em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='alle ToDos' />";
echo "</form>";
echo "</td>";
echo "</table></tr>";
}



echo "</body>";
echo "</html>";


} else {
   echo "Bitte erst einloggen!";
   header("Location: ./login_ad.php?back=index");

}

include("./fuss.php");

?>
