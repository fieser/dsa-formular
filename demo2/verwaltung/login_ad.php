<?php 


include("./kopf.php");


date_default_timezone_set('Europe/Berlin');

echo "<h1 style='margin-bottom: 1em;'>DEMO-Server - Anmeldung Schülerinnen und Schüler</h1>";

if ($_GET['test'] == "BbsAj-55122rlp") {
	
	
session_name("demoversion");	
@session_start();


		$_SESSION['username'] = "bbsTester";
		
		 $_SESSION['lastname'] = "Testmann";
		 $_SESSION['firstname'] = "Testi";
		 $_SESSION['mail'] = "ihre.mailadresse@testmann.xy";



						 
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
  flex: 30%;
  text-align: left;
}

.flex-item-right {
  padding: 10px;
  flex: 70%;
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
<div class='flex-container'>
	<div class='flex-item-left'>
				<form method="post" action="https://anmeldung.bbs1-mainz.de/demo/anmeldung" target="_blank">
		<input style="width: 23.3em; margin-bottom: 2em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Öffentliches Anmeldeformular" />
		</form>
			
			<form method="post" action="./index.php">
		<input style="width: 23.3em; margin-bottom: 2em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Startseite des Sekretariats" />
		</form>

			<form method="post" action="./installation.php">
		<input style="width: 23.3em; margin-bottom: 2em;" class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="Download der Skriptvorlagen"  />
		</form>
	</div>
	
	<div class='flex-item-right' style='text-align: left;'>
		<div class='box-grau' style='background-color: #A9D0F5'>
		<p><b>Wir stellen Ihnen hier eine Demoversion der Onlineanmeldung der BBS1-Mainz vor.<br>
		Es handelt sich um eine Enwicklung vom Team der BBS1-Mainz für die BBS1-Mainz und keine Dienstleistung für andere Schulen.</b></p>
		<p>Die entwickelten Skripte stellen wir hier aber gerne zur Verfügung, können von Ihnen genuzt, angepasst und weiterentwickelt werden.</p>
		<p style='margin-top: 2em;'><i>Dirk Fieser, BBS1 Mainz - <a href='mailto:dirk.fieser@bbs1-mainz.de'>dirk.fieser@bbs1-mainz.de</a></i></p>
		</div>
	</div>
	</div>


<h2>Umgesetzte Funktionen</h2>

<ul>
<li>Anmeldeformular mit edoo.sys-Wertelisten</li>
<li>Auswahl des Ausbildungsbetriebes</li>
<li>Automatische Generierung der Liste an der Schule verfügbarer Ausbildungsberufe</li>
<li>Vorausgefüllte Felder bei weiterenn Anmeldungen</li>
<li>Vermeidung Doppelter Anmeldungen für eine Schulform</li>
<li>Priorisierung mehrerer Anmeldungen für unterschiedlicher Schulformen</li>
<li>Generierung eines Anschreibens als PDF-Datei zur Zusendung der Bewerbungsunterlagen</li>

<li>Liste eingegangener Anmeldungen</li>
<li>Datensatzansicht</li>
<li>Regelmäßiger Abgleich mit edoo.sys-Daten</li>
<li>Generierung einer ToDo-Liste mit fehlenden Einträgen und Eingabefehlern</li>
<li>Automatische Anpassung des Anmeldestatus</li>

<li>Automatische Verlinkung von Anmeldungen an mehreren Schulformen</li>
<li>Registrierung fehlender Anmeldeunterlagen</li>
<li>Notizmöglichkeit für jede eingegangene Anmeldung</li>
<li>Einfache Kontaktaufnahem per E-Mail</li>

<li>Generierung der Import-Excel-Datei für edoo.sys</li>
<ul>
	<li>Es werden jeweils die aktuell gefiltereten Datensätze mit Status <i>vollständig</i> exportiert.</li>
	<li>Weil die eingegangenen Anmeldungen reglmäßig mit edoo.sys verglichen werden, werden niemals bereits erfasste Daten exportiert.
		<br>Außerdem verhindert die Import-Schnittstelle von edoo.sys den Import doppelter SuS.</li>
	<li>Die Bewerber werden den in edoo.sys angelegten Bewerbungszielen zugeordnet.<br>
		Aus diesen gerneriert sich auch automatisch die Auswahlliste im Anmeldeformular.</li>
	<li>Leider können über die für edoo.sys vorgegebene Excel-Datei nicht alle Daten importiert werden.<br>
		Alle Daten betreffend des Ausbildungsverhältnisses müssen hänsich ergänzt werden.<br>
		Dabei unterstützt und überprfüft aber die Funkton <i>ToDo-Liste</i></li>
	</ul>

</ul>

<h2>Geplante Funktionen</h2>

<ul>
<li>Abfrage des Bearbeitungsstatus für Schüler, Eltern und Betriebe</li>
<li>Schulformabhängige Auswahlliste für höchst. allg. Abschluss</li>
</ul>

<h2>Infrastruktur</h2>
<ul>
<li><b>edoo.sys DSS</b> (bereits vorhanden)</li>
	<ul>
	<li>Zeitgesteuerter Export von Wertelisten und Schülerdaten</li>
	<li>Zeitgesteuerter Transfer von Wertelisten zum öffentlichen Webserver</li>
	<li>Zeitgesteuerter Transfer von Schülerdaten zum internen Webserver</li>
	</ul>

<li><b>Öffentlicher Webserver</b> (Apache/MySQL/PHP) mit Anmeldeformular</li>
	<ul>
	<li>Bereitstellung des Formulars</li>
	<li>Liest und beschreibt Datenbank des internen Servers</li>
	</ul>

<li><b>Interner Webserver</b> (Apache/MySQL/PHP) für Sekretariatszugriff</li>
	<ul>
	<li>Weboberfläche für die Schulverwaltung</li>
	<li>Speicherung der Anmeldedaten</li>
	<li>Zeitgesteuerte Abgleich der Anmeldedaten mit den Daten vom DSS erhaltenen Schülerdaten</li>
	</ul>

</ul>

<img src='./systemskizze.jpg'>


</body>
</html>


<?php


} else {
	
echo "<p>Sie verfügen nicht über die nögigen Berechtigungen.</p>";
}
include("./fuss.php");

?>	