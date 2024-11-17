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
  padding: 10px 10px 10px 0px;
  flex: 30%;
  text-align: left;
}

.flex-item-right {
  padding: 10px;
  flex: 60%;
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
    <h1 style='margin-bottom: 2em;'>Digitale Schüleranmeldungen</h1>
	
<div class='flex-container'>
<div class='flex-item-left'>
	<form method="post" action="./liste.php">
<input style="width: 23.3em; margin-bottom: 2em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Liste Schüleranmeldungen" />
</form>
<?php

if ($_SESSION['sek'] == 1 OR $_SESSION['admin'] == 1 OR $_SESSION['ft'] == 1) {	
?>
<form class='flex-container' method="post" action="./todo.php">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="ToDo-Liste" />
</form>
<?php
} else {
?>
<form class='flex-container' method="post" action="./todo.php">
<input style="width: 23.3em;" class='btn btn-defau	lt btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="ToDo-Liste" disabled />
</form>
<?php
}
/*
if ($_SESSION['admin'] == 1) {	
?>
<form  class='flex-container' method="post" action="./import_edoo.php">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="edoo.sys-Daten aktualisieren"  />
</form>
<?php
} 

if ($_SESSION['admin'] == 1) {	
?>
<form  class='flex-container' method="post" action="./fehler_ermitteln.php">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Abweichungen ermitteln"  />
</form>
<?php
}

*/
if ($_SESSION['sek'] == 1 OR $_SESSION['admin'] == 1 OR $_SESSION['ft'] == 1) {	
?>
<form class='flex-container' method="post" action="./senden_texte.php">
<input style="width: 23.3em; margin-bottom: 2em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Hinweistexte anpassen" />
</form>
<?php
} else {
?>
<form class='flex-container' method="post" action="./todosenden_textephp">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Hinweistexte anpassen" disabled />
</form>
<?php
}

/*
if ($_SESSION['admin'] == 1) {	
?>
<form  class='flex-container' method="post" action="./statistik.php">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Statistik" disabled />
</form>
<?php
}
*/
?>

<form class='flex-container' method="post" target='-blank' action="https://anmeldung.bbs1-mainz.de/demo/anmeldung/">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Formularseite auf Website" />
</form>
<form class='flex-container' method="post" action="https://anmeldung.bbs1-mainz.de/demo/verwaltung/login_ad.php?test=BbsAj-55122rlp">
<input style="width: 23.3em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Info Funktionsumfang und Installation" />
</form>
</div>
<div class='flex-item-right'>
<div class='box-grau' style='background-color: #A9D0F5'>
<h2 style='margin-top: 0px;'><b>Heinweis zu dieser Demo</b></h2>
<p>Diese Demo für das Anmeldeformular und das Verwaltungstool des Schulsekretariats präsentiert nicht die aktuelle Progammversion, 
sondern entspricht dem Entwicklungsstand vom <nobr>November 2023.</nobr></p>
<p>Es ist sehr aufwändig das Zusammenspiel zwischen den Webservern und edoo.sys DSS abzubilden und entsprechende Testdatensätze zu generieren.</p>
<p><b>Wir führen Ihnen aber auch gerne das Produktivsystem unserer Schule vor.</b></p>
<p style='margin-top: 2em;'><i>Dirk Fieser, BBS1 Mainz - <a href='mailto:dirk.fieser@bbs1-mainz.de'>dirk.fieser@bbs1-mainz.de</a></i></p>
		

</div>
</div>
</div>
</body>
</html>
<?php


echo "Berechtigungen: ".$rechte;

} else {
   echo "Bitte erst einloggen!";
   header("Location: ./login_ad.php?back=index");

}

include("./fuss.php");

?>
