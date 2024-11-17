<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");





?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerberdaten</title>
    <style>


.box-grau {
   padding: 10 10 0 10px;
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
  flex: 30%;
  text-align: left;
  
  	  .center p {
	  vertical-align: middle;
	}

}

.flex-item-pfeil {
  padding: 10px;
  flex: 15%;
  text-align: center;
  padding: 0px;
  
	  .center p {
	  vertical-align: middle;
	}
	
	
}

.flex-item-center {
  padding: 10px;
  flex: 30%;
  text-align: left;
  
    .center p {
	  vertical-align: middle;
  }
}

.flex-item-right {
  padding: 10px;
  flex: 30%;
  text-align: left;
  
  .center p {
	  vertical-align: middle;
  }
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

/* Füge die folgenden Media Queries hinzu */
@media screen and (max-width: 750px) {
  /* Ändere 600px auf die gewünschte Schwellenbreite */
  
  .flex-item-left {
    text-align: center;
  }
  
    .flex-item-right {
    text-align: center;
  }
  
  
      .flex-item-center .inhalte-werden-zentriert {
	display: table;
	margin-left: auto;
	margin-right: auto;
}

 .flex-item-center .zentriert {
	display: table-cell;
}
  
  .flex-item-left .rotate-image {
    transform: rotate(90deg);
  }

  .flex-item-pfeil .rotate-image {
    transform: rotate(90deg);
  }

  .flex-item-center .rotate-image {
    transform: rotate(90deg);
  }

  .flex-item-right .rotate-image {
    transform: rotate(90deg);
  }
  
  .mobile-off {
    display: none;
  }
  

 
}



</style>
</head>
<body>
    <h1 style='margin-bottom: 2em;'><b>Digitale Anmeldeformulare</b></h1>
<?php

if ($_SERVER['REMOTE_ADDR'] == "217.198.244.140" OR $wartungsmodus != 1) {

echo "<div class='box-grau mobile-off'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<h1 style='font-size: 1.4em;'><i><b>Sie haben bereits...</b></i></h1>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<h1 style='font-size: 1.4em;'><i><b>Klicken Sie hier...</b></i></h1>";
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<h1 style='font-size: 1.4em;'><i><b>...für Ihr Ziel:</b></i></h1>";
		echo "</div>";
	echo "</div>";
echo "</div>";


if ($bvj_aktiv == 1) {


echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>kein Abschluss</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		//echo "<div class='text-to-hide'>Hier anmelden:</div>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bvj'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsvorbereitungsjahr (BVJ)' /></p>";
		echo "</form>";
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Berufsreife</b> (Hauptschulabschluss), Duale Ausbildung</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}


if ($bf1_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Berufsreife</b> (Hauptschulabschluss)</p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bf1'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsfachschule 1 (BF 1)' /></p>";
		echo "</form>";
			//Schwerpunkt anzeigen:
			$select_st = $db_temp->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82060%' ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();
			if ($treffer_st > 1) {
			echo "<div class='inhalte-werden-zentriert' id='div1'>";
				echo "<div class='zentriert' id='div2'>";
				echo "<ul>";
				foreach($select_st as $st) {
					echo "<li>".$st['anzeigeform']."</li>";
				}
				echo "<ul>";
				echo "</div>";
			echo "</div>";
			}
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p>Zugang zur Berufsfachschule II möglich; oder Berufsschule in Dualer Ausbildung</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}
if ($bf2_aktiv == 1) {


echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Abschluss der <nobr>Berufsfachschule I</nobr><br></b> und Qualifikation für die BF II</p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bf2'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsfachschule 2 (BF 2)' /></p>";
		echo "</form>";


		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Qualifizierter Sekundarabschluss I</b> <nobr>(Mittlere Reife)</nobr></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}

if ($bfp_aktiv == 1) {


echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b><nobr>Sekundarabschluss I</nobr><br></b>oder eine <b>abgeschlossene Berufsausbildung</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./ausbildung.php?sf=bfp'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsfachschule Pflege (BFP)' /></p>";
		echo "</form>";


		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Ausbildungsabschluss<br>Pflegefachfrau bzw. Pflegefachmann</b></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}



if ($bs_aktiv == 1) {


echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Ausbildungsvertrag</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./ausbildung.php?sf=bs'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsschule' /></p>";
		echo "</form>";
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Abgeschlossene Berufsausbildung</b><br>gleichzeitig möglich: Qual.Sek I (Mittlere Reife), Fachschulreife</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}


if ($bgy_aktiv == 1) {
echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Qualifizierter Sekundarabschluss I</b><br>
				(Mittlere Reife)</p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bgy'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufliches Gymnasium (BGY)' /></p>";
		echo "</form>";
			//Schwerpunkt anzeigen:
			$select_st = $db_temp->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_85020%' ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();	
			if ($treffer_st > 1) {
			echo "<div class='inhalte-werden-zentriert' id='div1'>";
				echo "<div class='zentriert' id='div2'>";
				echo "<ul>";
				foreach($select_st as $st) {
					echo "<li>".$st['anzeigeform']."</li>";
				}
				echo "<ul>";
				echo "</div>";
			echo "</div>";
			}
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Allgemeine Hochschulreife</b> (Abitur) oder <b>Fachhochschulreife</b> nach Klasse 12 (schulischer Teil)</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}


if ($hbf_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Qualifizierter Sekundarabschluss I</b> <nobr>(Mittlere Reife)</nobr></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=hbf'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Höhere Berufsfachschule (HBF)' /></p>";
		echo "</form>";
		//Schwerpunkt anzeigen:
			$select_st = $db_temp->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_82049%' ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();	
			if ($treffer_st > 1) {
			echo "<div class='inhalte-werden-zentriert' id='div1'>";
				echo "<div class='zentriert' id='div2'>";
				echo "<ul>";
				foreach($select_st as $st) {
					echo "<li>".$st['anzeigeform']."</li>";
				}
				echo "<ul>";
				echo "</div>";
			echo "</div>";
			}
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Staatl. geprüfte/r Assistent/-in</b>; gleichzeitig möglich: <b>Fachhochschulreife</b>; Wechsel in Duales Ausbildungsverhältnis (mit Zeitanrechnung)</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}





if ($bos1_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Qualifizierter Sekundarabschluss I</b> <nobr>(Mittlere Reife)</nobr> und <b>abgeschlossene Berufsausubildung</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bos1'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsoberschule 1 (BOS 1)' /></p>";
		echo "</form>";
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Fachhochschulreife</b></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}
if ($bos2_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bos2'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsoberschule 2 (BOS 2)'/>";
echo "</form>";
}

if ($dbos_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Qualifizierter Sekundarabschluss I</b> <nobr>(Mittlere Reife)</nobr> und <b>abgeschlossene Berufsausubildung</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=dbos'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Duale Berufsoberschule (DBOS)' /></p>";
		echo "</form>";
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Fachhochschulreife</b></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}


if ($aph_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Berufsreife</b> (Hauptschulabschluss) oder <nobr><b>10 Jahre Schulbesuch</b></nobr></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=aph'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Fachschule Altenpflegehilfe (FS APH)' /></p>";
		echo "</form>";
			

		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Staatlich geprüfte Altenpflegehelfer:in</b> / ggf. Zugang Berufsfachschule Pflege</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}

if ($fsof_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Abgeschlossene Berufsausbildung als Fachkraft im Bereich Sozialwesen <nobr>oder Pflege</nobr></b>, 
		danach <b><nobr>zweijahrige Tätigkeit</nobr></b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=fsof'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='FS Organisation und Führung (FSOF)' /></p>";
		echo "</form>";
		
		//Schwerpunkt anzeigen:
			$select_st = $db_temp->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_8610071%' ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();	
			if ($treffer_st > 1) {
			echo "<div class='inhalte-werden-zentriert' id='div1'>";
				echo "<div class='zentriert' id='div2'>";
				echo "<ul>";
				foreach($select_st as $st) {
					echo "<li>".$st['anzeigeform']."</li>";
				}
				echo "<ul>";
				echo "</div>";
			echo "</div>";
			}
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Staatlich anerkannte Fachwirt:in für Organisation und Führung</b></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}


if ($fs_aktiv == 1) {

echo "<div class='box-grau'>";
	echo "<div class='flex-container'>";
		echo "<div class='flex-item-left'>";
		echo "<p><b>Abgeschlossene Berufsausbildung und Berufstätigkeit</b></p>";
				echo "</div>";

		echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-center'>";
		echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=fs'>";
		echo "<p><input style='width: 100%; min-width: 18em; font-size: 1.1em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Fachschule (FS)' /></p>";
		echo "</form>";
		//Schwerpunkt anzeigen:
			$select_st = $db_temp->query("SELECT anzeigeform FROM edoo_bewerbungsziel WHERE id_bildungsgang LIKE '1058_86060%' ORDER BY anzeigeform ASC");
			$treffer_st = $select_st->rowCount();	
			if ($treffer_st > 1) {
			echo "<div class='inhalte-werden-zentriert' id='div1'>";
				echo "<div class='zentriert' id='div2'>";
				echo "<ul>";
				foreach($select_st as $st) {
					echo "<li>".$st['anzeigeform']."</li>";
				}
				echo "<ul>";
				echo "</div>";
			echo "</div>";
			}
		echo "</div>";
		
				echo "<div class='flex-item-pfeil'>";
		echo "<p><img class='rotate-image' src='./images/pfeil.svg' height='50px'></p>";
		echo "</div>";

		echo "<div class='flex-item-right'>";
		echo "<p><b>Staatlich geprüfte/r Techni-ker/in; Fachhochschulreife</b></p>";
		echo "</div>";
	echo "</div>";
echo "</div>";
}

echo "</body>";
echo "</html>";

} else {
	
	echo "<h2>Aufgrund von Wartungsarbeiten ist die Onlineanmeldung bis einschließlich ".$wartungsmodus_ende." deaktiviert.</h2>";
}

include("./fuss.php");

?>
