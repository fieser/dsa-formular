<?php



include("./kopf.php");


include("./login_inc.php");
@session_start();




	
include("./config.php");

// Ist Nutzer angemeldet?
if (isset($_SESSION['username'])) {

/*
//Filter vorbereiten:
if (isset($_POST['f_nachname'])) {
$f_nachname = $_POST['f_nachname'];
}
if (isset($_POST['f_vorname'])) {
$f_vorname = $_POST['f_vorname'];
}
if (isset($_POST['f_geburtsdatum'])) {
$f_geburtsdatum = $_POST['f_geburtsdatum'];
}
if (isset($_POST['f_schulform'])) {
$f_schulform = $_POST['f_schulform'];
}
if (isset($_POST['f_beruf'])) {
$f_beruf = $_POST['f_beruf'];
}
*/






// angegebenen Verzeichnis oeffnen
$myDirectory = opendir("./installation/");
// Objekte lesen und in Array schreiben
while($entryName = readdir($myDirectory)) {
$dirArray[] = $entryName;
}
//Array sortieren - neuestes Objekt zuerst
sort($dirArray);
// Verzeichnis schliessen
closedir($myDirectory);
// Objekte im Array zaehlen
$indexCount = count($dirArray);


echo "<h1 style='margin-top: 2em; margin-bottom: 1em;'>Skript- und Datenbankvorlagen</h1>";
	
echo "<div style='margin-left: 2em;'>";
// Array durchlaufen und in einer Liste ausgeben
for($index=0; $index < $indexCount; $index++) {
$extension = substr($dirArray[$index], -3);
	if ($extension == 'zip' OR $extension == 'sql'){ // nur csv Dateien ausgeben
		

	//Dateien, die innerhalb der letzten 10 min aktualisiert wurden, werden blau angezeigt:	
	if ((time() - filemtime("./installation/".$dirArray[$index])) < 10*60) {
		$farbe = "blue";
	} else {
		$farbe = "black";
	}
		
	echo  "<p style='margin-top: 1em;'><font color='".$farbe."'><b><a href='./installation/".$dirArray[$index]."'>".$dirArray[$index]."</a></b></font> ".date ('d.m.Y H:i', filemtime("./installation/".$dirArray[$index]))."</p>";
	}
	
}



?>
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
<h1 style='margin-top: 2em;'>Hinweise zur Installation</h1>



<h2>Interner Webserver</h2>
<p>Kern des Sytems ist der interne Webserver. Das kann z.B., wie bei uns, eine VM mit einem Linux sein.</p>

	<ol>
	<li>Installieren und konfigurieren Sie einen Webserver (Apache, PHP und MySQL)</li>
	<li>Installieren Sie optional das Tool <i>phpMyAdmin</i>, das die Verwaltung der Datenbank deutlich erleichtert.</li>
	<li>Laden Sie sich die Datei <i>Dateien_interner_Webserver.zip</i> herunter speichern Sie den Inhalt im Webverzeichnis Ihres Servers.</li>
	<li>Laden Sie sich die Datenbankdateien <i>anmeldung_www_leer.sql</i> und <i>anmeldung_temp_leer.sql</i> herunter und importieren Sie sie in zwei separate MySQL-Datenbanken <i>anmeldung_www</i> und <i>anmeldung_temp</i>.
	<div class='box-grau' style='margin-top: 5px;'>
	<b>Zwei separate Datenbanken, weil...</b><br>
	...der öffentliche Server nicht auf alle Schülerdaten zugreifen können soll. Von außerhalb des Verwaltungsnetzes kann man nur auf die Datenbank <i>anmeldung_temp</i>
	 zugreifen. Das öffentliche Anmeldeformular schreibt in die Datenbank <i>anmeldung_temp</i>. Der interne Webserver nutzt aber grundsätzlich die Datenbank <i>anmeldung_www</i>.
	 Wenn das Sekretariat auf ihm die Anmeldeliste aufruft, werden alle neu eingegangenen Anmeldungen von der Datenbank <i>anmeldung_temp</i> in die Datenbank <i>anmeldung_www</i>
 verschoben.</div>
	</li>
	<li>Laden Sie sich die Datei <i>verbinden.zip</i> herunter und speichern Sie die darin enthaltenen php-Datein außerhalb Ihres Webverzeichnises.</i></li>
	<li>Legen Sie für beide Datenbanken die Nutzernamen und Zugriffsberechtigungen fest.</li>
	<li>Tragen Sie die Zugangsdaten zu den beiden MySQL-Datenbanken in die Dateien <i>verbinden_www.php</i> und <i>verbinden_temp.php</i> ein.</li>
	<li>In der Datei <i>config.php</i> können Sie die Email-Signatur der Schule konfigurieren.</li>
	<li>In der Datei <i>login_ad.php</i> können Sie die Verbindung zu Ihrem LDAP-Server (z.B. Windows ActivDirectory) konfigurieren.<br>
	Alternativ können Sie eine Benutzerverwaltung per MySQL-Datenbank einrichten.</li>
	<li>In der Datei <i>rechte.php</i> können Sie den Gruppen Admins, Sekretariatskräften und Lehrkräften Nutzernamen zuordnen.</li>
	<li>Das Layout (Stylesheet) wird in der Datei kopf.php geladen. Dort wird auch das Schullogo eingebunden.</li>
	<li>Installieren Sie über die Linux-Paketverwaltung das Tool <i>ImageMagick</i>, damit PHP Vorschaubilder generieren kann.</li>
	<li>Optional: Installieren Sie Python3, um das Skript zur Generierung der Excel-Importdatei für edoo.sys RLP direkt auf dem Server generieren zu können. 
	Dieses Skript befindet sich im Verzeichnis ./export/. Testen Sie es zunächst in der Linux-Konsole, um evtl. fehlende Python-Module zu bemerken und nachinstallieren zu können.<br></li>
	</ol>


<h2>Öffentlicher Webserver</h2>
<p>Dieser Webserver befindet sich außerhalb des Verwaltungsnetzes.<br>Wir haben einen VServer bei <i>Strato</i> - 11,- Euro/M.) - angemietet.</p>

	<ol>
	<li>Installieren und konfigurieren Sie auch hier einen Webserver (Apache mit PHP).</li>
	<li>Eine Datenbank wird nicht benötigt.</li>
	<li>Laden Sie sich die Datei <i>Dateien_öffentlicher_Webserver.zip</i> herunter speichern Sie den Inhalt im Webverzeichnis Ihres Servers.</li>
	<li>In der Datei <i>config.php</i> können Sie Ihre Schulformen aktivieren und deaktivieren.</li>
	<li>Die Schwerpunkte/Fachrichtungen der einzelnen Schulformen werden nicht auf diesem Server, sondern direkt in edoo.sys über die definierten Bewerbungsziele konfiguriert.</li>
	<li>Speichern und konfigurieren Sie in der Datei <i>verbinden_temp.php</i> die Verbindung zur Datenbank <i>anmeldung_temp</i> des internen Webservers.<br>
	Sichern Sie die Verbindung zur Datenbank <i>anmeldung_temp</i> des internen Servers bestmöglich ab.</li>
	<li>Passen Sie die Datei <i>.htaccess</i> im Unterverzeichnis <i>dokumente</i> an.<br>
	Dort muss zumindest die öffentliche IP des internen Webservers freigegeben sein.</li>
	
	<div class='box-grau' style='margin-top: 5px;'>
	<b>Sicherheitskonzept bezüglich Upload von Zeugnissen und Ausweisdokumenten:</b><br>
	<ul>
	<li>Übertragung per SSL</li>
	<li>Verschlüsselte Speicherung auf dem öffentlichen Server (AES-256)</li>
	<li>Dynamische Passwörter je Datensatz</li>
	<li>Regelmäßige "Abholung" durch (ausschließlich) den internen Webserver</li>
	<li>Lediglich temporäre Speicherung (max. 40 min) auf dem öffentlichen Webserver</li>
	<li>Langzeitspeicherung nur auf dem internen Webserver</li>
	</ul>
	</div>
	
	</ol>
	
	<h2>Ex- und Import der edoo.sys-Daten</h2>
	<p>Unser edoo.sys-Server (DSS) läuft auf einem Windows-System.</p>

	<ol>
	<li>Laden Sie sich die Datei <i>export-skript_edoosys.zip</i> herunter speichern Sie die sich darin befindende PowerShell-Skript in einem Verzeichnis auf dem edoo.sys-Server.</li>
	<li>Im Skript müssen einige Variablen konfiguriert werden.</li>
	<li>Das Skript exportiert die Wertelisten und Schülerdaten und kopiert sie auf den internen Webserver. Erstellen Sie (mit <i>Puttygen</i>) ein Zertifikat, mit dem sich das Skript per SSH-Verbindung am Server authentifizieren kann. Testen Sie das Skript und starten Sie es regelmäßig über die Windows-Aufgabenplanung.</li>
	<li>Entpacken Sie die Datei <i>bash-skript_fuer_DB-Import.zip</i> und kopieren Sie die beiden Dateien auf den internen Webserver (außerhalb des Webverzeichnisses).
	<br>In den beiden Shellskripten müssen ggf. noch Pfade angepasst werden.</li>
	<li>Richten Sie auf dem internen Werserver zwei Cronjobs ein, die regelmäßig die Dateien <i>check_upload_edoo2anmeldung.sh</i> und <i>vorschaubilder.sh</i> ausführen.<br>
	Sie importieren die edoo.sys-Daten und generieren Vorschaubilder für eingereichte Nachweisdokumente.</li>
	</ol>


<p>Alle hier zum Download bereitgestellten Dateien dürfen beliebig angegepasst, weiterentwickelt und weitergereicht werden.
Die Verwendung erfolgt jedoch auf Ihre eingene Verantwortung. Wir übernehmen keine Haftung für durch deren Nutzung entstandener Schäden.</p>



<p>
<form method="post" action="./login_ad.php?test=BbsAj-55122rlp">
<input type="submit" class='btn btn-default btn-sm' style='margin-top: 4em;' name="cmd[doStandardAuthentication]" value="zurück" />
</form></p>
<?php
} else {
   echo "Bitte erst einloggen!";
   header("Location: ./login_ad.php?back=liste");

}
	include("./fuss.php");
?>