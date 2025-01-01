<?php

include("./kopf.php");

date_default_timezone_set('Europe/Berlin');



@session_start();



// Ist Nutzer angemeldet?
if (isset($_SESSION['betriebe_user'])) {



include "./config.php";


if (isset($_POST['submit_senden'])) {
	
	//Versand der Email dokumentieren:
	
		$id = intval($_GET['id']);
		$mailtext = $_POST['bodytext_final'];
		
		$last_user = $_SESSION['lastname'];
		$last_time = time();
	
	if ($log == "") {
			$log = date('Y-m-d H:m')."_".$last_user."geändert \n";
			}
			
			if ($db->exec("INSERT INTO `mail`
								   SET
									`id_dsa_bewerberdaten` = '$id',
									
									`mailtext` = '$mailtext',
									`last_time` = '$last_time',
									`log` = '$log',
									`last_user` = '$last_user'")) {
					
					$last_id = $db->lastInsertId();
									}
	
	
	
	
	echo "<div class='box-grau' style='background: #7FFFD4;'>Ihre Nachricht wurde versendet</div>";
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



/* Tabs mit radio-Buttons */
.tabbed figure { 
   display: block; 
   margin-left: 0; 
   border-bottom: 1px solid silver;
   clear: both;
}

.tabbed > input,
.tabbed figure > div { display: none; }

.tabbed figure>div {
  padding: 20px;
  width: 100%;
  border: 1px solid silver;
  background: #fff;
  line-height: 1.5em;
  letter-spacing: 0.3px;
  color: #444;
}
#tab1:checked ~ figure .tab1,
#tab2:checked ~ figure .tab2,
#tab3:checked ~ figure .tab3,
#tab4:checked ~ figure .tab4,
#tab5:checked ~ figure .tab5,
#tab6:checked ~ figure .tab6 { display: block; }


nav label {
   float: left;
   padding: 5px 10px;
   border-top: 1px solid silver;
   border-right: 1px solid silver;
   background: hsl(214.15,28%,46%);
   color: #eee;
}

nav label:nth-child(1) { border-left: 1px solid silver; }
nav label:hover { background: hsl(214.14,28%,41%); }
nav label:active { background: #ffffff; }

#tab1:checked ~ nav label[for="tab1"],
#tab2:checked ~ nav label[for="tab2"],
#tab3:checked ~ nav label[for="tab3"],
#tab4:checked ~ nav label[for="tab4"],
#tab5:checked ~ nav label[for="tab5"],
#tab6:checked ~ nav label[for="tab6"] {
  background: white;
  color: #111;
  position: relative;
  border-bottom: none;
}

#tab1:checked ~ nav label[for="tab1"]:after,
#tab2:checked ~ nav label[for="tab2"]:after,
#tab3:checked ~ nav label[for="tab3"]:after,
#tab4:checked ~ nav label[for="tab4"]:after,
#tab5:checked ~ nav label[for="tab5"]:after,
#tab6:checked ~ nav label[for="tab6"]:after {
  content: "";
  display: block;
  position: absolute;
  height: 2px;
  width: 100%;
  background: white;
  left: 0;
  bottom: -1px;
}
</style>


<?php

$id_betrieb = $_SESSION['betriebe_user'];

$select_btr = $db_temp->query("SELECT * FROM betriebe WHERE id_edoo = '$id_betrieb'");	
		foreach($select_btr as $btr) {
			
			$_SESSION['betriebe_name1'] = $btr['name1'];
			$_SESSION['betriebe_kuerzel'] = $btr['kuerzel'];


echo "<h2 style='padding: 5 0 25 0px;'><b>".$btr['name1']."</b>  <font style='font-size: 0.8em;'></font></h2>";
	 
		 
		 



	

?>
	
<div class="tabbed">
<?php
$selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 1; // Standardmäßig auf Tab 1 setzen, wenn $_GET['tab'] nicht gesetzt ist
for ($tabIndex = 1; $tabIndex <= 6; $tabIndex++) {
    // Prüfen, ob der aktuelle TabIndex dem ausgewählten Tab entspricht
    $isChecked = $selectedTab == $tabIndex ? "checked='checked'" : "";
    echo "<input $isChecked id='tab$tabIndex' type='radio' name='tabs' />";
}
?>

   
   <input id="tab2" type="radio" name="tabs" />
   <input id="tab3" type="radio" name="tabs" />
   <input id="tab4" type="radio" name="tabs" />
   <input id="tab5" type="radio" name="tabs" />
   <input id="tab6" type="radio" name="tabs" />



   <nav>
      <label for="tab1">Stammdaten</label>
      <label for="tab2">Ansprechparner</label>
	  <label for="tab3">Auszubildende</label>
	  <?PHP
	  if ($_SESSION['admin'] == 1 OR $_SESSION['sek'] == 1) {
      echo "<label for='tab5'>Status</label>";
	  echo "<label for='tab6'>Kontakt</label>";
	  }
	  ?>
   </nav>
   
   <figure>
      <div class="tab1"> 
	  <?php
	  
	  echo "<table>";
	  echo "<tr'><td style='padding: 5;'><b>Betriebsname:</b></td>
			<td style='padding: 5;'>".$btr['name1']."</td>
			<td style='padding: 0 20;'></td>
			
			<td style='padding: 5;'><b>Telefon:</b></td>			
			<td style='padding: 5;'>".$btr['betrieb_telefon']."</td></tr>";
			
			
	  echo "<tr><td style='padding: 5;'></td>			
			<td style='padding: 5;'>".$btr['name2']."</td>
			<td style='padding: 0 20;'></td>
			
			<td style='padding: 5;'><b>E-Mail:</b></td>			
			<td style='padding: 5;'>".$btr['betrieb_mail']."</td></tr>";
			
			
	  echo "<tr'><td style='padding: 5;'><b>Anschrift:</b></td>			
			<td style='padding: 5;'>".$btr['betrieb_strasse']." ".$btr['betrieb_hausnummer']."</td>
			<td style='padding: 0 20;'></td>
			
			<td style='padding: 5;'></b></td>			
			<td style='padding: 5;'></td></tr>";
			
			
	  echo "<tr'><td style='padding: 5;'></td>			
			<td style='padding: 5;'>".$btr['betrieb_plz']." ".$btr['betrieb_ort']."</td>
			<td style='padding: 0 20;'></td>";
			
	  echo "</tr>";

	  echo "</table>";
	  
	  ?>
	  </div>
      <div class="tab2">
	  <?php

		$select_aub = $db_temp->query("SELECT * FROM ausbilder WHERE ausbilder_betrieb_id = '$id_betrieb'");	
		
		echo "<table>";
		
		foreach($select_aub as $aub) {

	  
	   
	   
	  echo "<tr'><td style='padding: 5;'><b></b></td>
			<td style='padding: 5;'><b>".$aub['ausbilder_vorname']." ".$aub['ausbilder_nachname']."</b></td>
			
			<td style='padding: 5 5 30 20;'>&#9993; ".$aub['ausbilder_mail']."</td>

			<td style='padding: 5 5 30 20;'><b>&#9990;</b> ".$aub['ausbilder_telefon']."</td>";

			if ($bew['ausbilder_telefon2'] != "") {
			echo "<td style='padding: 5 5 5 20;'>&#9990; ".$bew['ausbilder_telefon2']."</td>";
			}
			
			//echo "<td style='border: 3; padding: 5 5 5 20;'></td>";
			echo "</tr>";
		}
		echo "</table>";
	
	  ?>
	  
	  </div>
      <div class="tab3">

		<?php
		
		echo "<table>";
		echo "<tr><td style='padding: 5;'><i>Funktion noch nicht verfügbar.</i></td></tr>";
	  	echo "</table>";
	  
		
	  ?>


	  </div>

	  <div class="tab5">
	  <?PHP
		 		//Gespeicherte Werte abrufen:
		
					$select_vo = $db->query("SELECT * FROM vorgang WHERE id_dsa_bewerberdaten = '$id'");	
					foreach($select_vo as $vo) {		
					$dok_erfahrung = $vo['dok_erfahrung'];
					$dok_zeugnis = $vo['dok_zeugnis'];
					$dok_lebenslauf = $vo['dok_lebenslauf'];
					$dok_ausweis = $vo['dok_ausweis'];
					$bemerkungen = $vo['bemerkungen'];
					$last_time = $vo['last_time'];
					$last_user = $vo['last_user'];
					
					}
					
					//Für versendete Emails:
					$select_em = $db->query("SELECT * FROM mail WHERE id_dsa_bewerberdaten = '$id' ORDER BY last_time ASC");	
					foreach($select_em as $em) {		
					
					$em_mailtext = $em['mailtext'];
					$em_last_time = $em['last_time'];
					$em_last_user = $em['last_user'];
					
					}
		
		
			

		?>
<div class='flex-container'>
	<div class='flex-item-left'>
	<form id="inputForm1" action="datenblatt.php?id=<?PHP echo "$id" ?>" method="post">
	
	<input type='hidden' name='id' value='<?PHP echo "$id" ?>'>
		<table>
		<tr>
		<td style='padding-bottom: 3px;'><b>Bemerkungen:</b></td><tr>

		<tr>
		<td colspan='3'><label><textarea style='width:100%;' name='bemerkungen' cols='60' rows='6'><?PHP echo "$bemerkungen" ?></textarea></p></label>
		</tr>


		<tr><td colspan='2'><input class='btn btn-default btn-sm' style='margin-bottom: 2em;' type="submit" id="inputForm1" name="submit" value="speichern" />
		
		
		<?PHP

		if ($last_user != "") {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<small><i>Zuletzt ".date('d.m.Y, H:m', $last_time)." Uhr gespeichert von ".$last_user.".</i></small>";
		}
		?>
		</td>
		
		<td>

		</td>
		</tr>
		<?PHP
		
	
		?>
		
		
		
		
		</table>
		</div>
		
		<div class='flex-item-left' style='padding-left: 20pxf'>
		<?PHP
		if ($bil['schulform'] != "bs") {
		?>
		
		<table>
		<tr>
		<td style='padding: 5px;' colspan='2'><b>Eingereichte Unterlagen:</b></td>
		</tr>



		<tr><td style='padding: 5px;'>
		<?php
			if ($dok_zeugnis == 1) {
				echo "<input style='padding: 10px;' type='checkbox' id='1' name='dok_zeugnis' value='1' checked>";
			} else {
				echo "<input style='padding: 10px;' type='checkbox' id='1' name='dok_zeugnis' value='1'>";
			}
			echo "</td><td style='padding: 5px;'>";
			echo "Zeugnisse";
			?>
			
			</td>
			</tr>
			<?php
			
			echo "<tr><td style='padding: 5px;'>";
			
			if ($dok_lebenslauf == 1) {
				echo "<input style='padding: 10px;' type='checkbox' id='2' name='dok_lebenslauf' value='1' checked>";
			} else {
				echo "<input style='padding: 10px;' type='checkbox' id='2' name='dok_lebenslauf' value='1'>";
			}
			echo "</td><td style='padding: 5px;'>";
			echo "Lebenslauf";
			?>
			
			</td>
			</tr>
			<?php
			
			echo "<tr><td style='padding: 5px;'>";
			
			if ($dok_ausweis == 1) {
				echo "<input style='padding: 10px;' type='checkbox' id='3' name='dok_ausweis' value='1' checked>";
			} else {
				echo "<input style='padding: 10px;' type='checkbox' id='3' name='dok_ausweis' value='1'>";
			}
			echo "</td><td style='padding: 5px;'>";
			echo "Personalausweis / Meldebescheinigung";
			?>
			
			</td>
			</tr>
			<?php
			if ($bil['schulform'] == "bos1" OR $bil['schulform'] == "bos2" OR $bil['schulform'] == "dbos" OR $bil['schulform'] == "fs" OR $bil['schulform'] == "fsof") {
			
			echo "<tr><td style='padding: 5px;'>";
			
			if ($dok_erfahrung == 1) {
				echo "<input style='padding: 10px;' type='checkbox' id='4' name='dok_erfahrung' value='1' checked>";
			} else {
				echo "<input style='padding: 10px;' type='checkbox' id='4' name='dok_erfahrung' value='1'>";
			}
			echo "</td><td style='padding: 5px;'>";
			echo "Berufsabschluss bzw. Berufserfahrung";
			
			
			echo "</td></tr>";
			
			}
		}
		
				//Wenn es noch weitere Anmeldungen gibt:
					$nachname = $bew['nachname'];
					$vorname = $bew['vorname'];
					$geburtsdatum = $bew['geburtsdatum'];
					
					$select_bew_dub = $db->query("SELECT id FROM dsa_bewerberdaten WHERE nachname = '$nachname' AND vorname = '$vorname' AND geburtsdatum = '$geburtsdatum'");	
					$treffer_bew_dub = $select_bew_dub->rowCount();
					
					if ($treffer_bew_dub > 1 AND $bil['schulform'] != "bs") {
					
					echo "<tr><td colspan='2' style='padding: 20 5 5 5; color: red;'><b>Speichern und Unterlagen ggf. auch hier prüfen:</b><br></td></tr>";
						foreach($select_bew_dub as $dub) {
						$dub_id = $dub['id'];
						$bew_id = $bew['id'];
						//echo "<tr><td style='padding: 5;'></td></tr>";
						
						$select_bil_dub = $db->query("SELECT DISTINCT md5, prio, schulform, id_dsa_bewerberdaten FROM dsa_bildungsgang WHERE id_dsa_bewerberdaten = '$dub_id' AND id_dsa_bewerberdaten != '$bew_id'");	
						foreach($select_bil_dub as $bild_dub) {
							$bild_dub_md5 = $bild_dub['md5'];
							
							
							$select_sum = $db_temp->query("SELECT * FROM summen WHERE md5 = '$bild_dub_md5'");	
							$sum_prio = "";
							foreach($select_sum as $sum) {
								$sum_prio = $sum['prio'];
							}
						If ($sum_prio == "") {
							$sum_prio = $bild_dub['prio'];
						}
							
							if ($sum_prio != "") {
								echo "<tr><td colspan='2' style='padding: 5;'><a href='./datenblatt.php?id=".$bild_dub['id_dsa_bewerberdaten']."&tab=5'>Anmeldung für <b>".strtoupper($bild_dub['schulform'])."</b> - Priorität <b>".$sum_prio."</b></a></td></tr>";
							} else {
								echo "<tr><td colspan='2' style='padding: 5;'><a href='./datenblatt.php?id=".$bild_dub['id_dsa_bewerberdaten']."&tab=5'>Anmeldung für <b>".strtoupper($bild_dub['schulform'])."</b></a></td></tr>";
							}
						//Auch Dokumente in anderen Bildungsgängen markieren:
						echo "<input type='hidden' name='id_".$bild_dub['prio']."' value='".$bild_dub['id_dsa_bewerberdaten']."'>";
						}
						}
					}
?>
		</table>
		
		</form>
		
		<?PHP
		if ($em_last_user != "") {
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		
		echo "<p><small><i><a href='./mail_verlauf.php?id=".$id."' target='fenster' onclick=\"window.open('./mail_verlauf.php', 'fenster', 'width=800,height=450,top=200,left=100,status,resizable,scrollbars')\"><b>Letzte E-Mail</b></a> versendet am ".date('d.m.Y, H:m', $em_last_time)." Uhr von ".$em_last_user.".</i></small></p>";
		//echo "<a href='./mail_verlauf.php' target='fenster' onclick=\"window.open('./mail_verlauf.php', 'fenster', 'width=600,height=450,status,resizable,scrollbars')\">Link</a>";

		
		}
		?>
		</div>
</div>


	  </div>
	  
	  <div class="tab6">
	  <?PHP
if (!isset($_POST['submit_senden'])) {


//Schüler bereits volljährig?
if (strtotime($bew['geburtsdatum']) < (time() - 18*365*24*3600)) {
	$volljaehrig = 1;
} else {
	$volljaehrig = 0;
}


$cc = "";
if ($volljaehrig == 0) {
	if ($bew['sorge1_mail'] != "" AND $bew['sorge2_mail'] == "") {
		$cc = $bew['sorge1_mail'];
	}
	if ($bew['sorge1_mail'] != "" AND $bew['sorge2_mail'] != "") {
		$cc = $bew['sorge1_mail'].";".$bew['sorge2_mail'];
	}
}

if ($bew['geschlecht'] == "W") {
$bodytext = "Sehr geehrte Frau ".trim($bew['nachname']).",\n";
}

if ($bew['geschlecht'] == "M") {
$bodytext = "Sehr geehrter Herr ".trim($bew['nachname']).",\n";
}
if ($bew['geschlecht'] == "D" OR $bew['geschlecht'] == "O") {
$bodytext = "Guten Tag ".$bew['vorname']." ".$bew['nachname'].",\n";
}

$bodytext .= "\n";

if ($bil['schulform'] != "bs" AND ($dok_ausweis != 1 OR $dok_lebenslauf != 1 OR $dok_zeugnis != 1 OR ($dok_erfahrung != 1 AND ($bil['schulform'] == "fs" OR $bil['schulform'] == "fsof" OR $bil['schulform'] == "bos1" OR $bil['schulform'] == "bos2" OR $bil['schulform'] == "dbos")))) {
$bodytext .= "um Ihre Anmeldung bearbeiten zu können fehlen uns noch die folgenden Unterlagen:\n";

$bodytext .= "\n";
	if ($dok_ausweis != 1) {
		$bodytext .= "- Personalausweis oder Meldebescheinigung \n";
	}
	
	if ($dok_lebenslauf != 1) {
		$bodytext .= "- Lebenslauf \n";
	}
	
	if ($dok_zeugnis != 1) {
		$bodytext .= "- Zeugnis in beglaubigter Form \n";
		$bodytext .= "  (nur Halbjahreszeugnisse ohne Beglaubigung) \n";
	}
	
	if ($dok_erfahrung != 1 AND ($bil['schulform'] == "fs" OR $bil['schulform'] == "fsof" OR $bil['schulform'] == "bos1" OR $bil['schulform'] == "bos2" OR $bil['schulform'] == "dbos")) {
		$bodytext .= "- Nachweis Ihrer Berufserfahrung \n";
	}
$bodytext .= "\n";
$bodytext .= "Bitte lassen Sie uns die fehlenden Unterlagen umgehend per Post oder persönlich zukommen!\n";

if ($upload_documents == 1 AND $bil['schulform'] != "bs") {
	$bodytext .= "\n";
	$bodytext .= "Unterlagen, die nicht beglaubigt sein müssen, können Sie über diesen Link auch online einreichen:\n";
	$bodytext .= "\n";
	$bodytext .= "https://anmeldung.bbs1-mainz.de/upload.php?id=".md5($bew['mail'].$bew['geburtsdatum'])." \n";
}

} else {

$bodytext .= "\n";
$bodytext .= "\n";

$bodytext .= "\n";
}
$bodytext .= "\n";
$bodytext .= "\n";
$bodytext .= "Mit freundlichen Grüßen \n";
$bodytext .= "\n";
$bodytext .= "i.A. ".$_SESSION['firstname']." ".$_SESSION['lastname']." \n";
$bodytext .= "\n";
$bodytext .= "_______________________________________________ \n";
$bodytext .= $_SESSION['schule_name_zeile1']."\n";
$bodytext .= $_SESSION['schule_name_zeile2']."\n";
$bodytext .= "\n";
$bodytext .= $_SESSION['schule_strasse_nr']."\n";
$bodytext .= $_SESSION['schule_plz_ort']."\n";
$bodytext .= "\n";
$bodytext .= $_SESSION['schule_tel']."\n";
$bodytext .= $_SESSION['schule_fax']."\n";
$bodytext .= "\n";
$bodytext .= $_SESSION['schule_mail']."\n";
$bodytext .= $_SESSION['schule_url']."\n";



//Kopfzeilen (optisch):
echo "<table>";
//echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>An:</b></td><td style='max-width: 60em;'>".$bew['mail']." <small><i>(Schüler/-in)</i></small></td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>Cc:</b></td><td style='max-width: 60em;'>".str_replace(";","; ",$cc)."</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>Betreff:&nbsp;</b></td><td style='max-width: 60em;'>Ihre Anmeldung an der Berufsbildenden Schule 1 - Mainz</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "</table>";


} //Ende wenn kein submit

//Mailversand:
	if (isset($_POST['submit_senden'])) {
		
		

		
		
		$bodytext = $_POST['bodytext_final'];
		$empfaenger = $_POST['empfaenger'];
		$cc = $_POST['cc'];
		
		



		$header = [];
		$header[] = 'MIME-Version: 1.0';
		$header[] = 'Content-type: text/plain; charset=utf-8';
		$header[] = 'From: Service BBS1 Mainz <service@bbs1-mainz.de>';
		$header[] = "Reply-To: ".$_SESSION['mail'];
		$header[] = 'Content-Transfer-Encoding: 8bit';
		$header[] = "cc: ".$cc;
		$header[] = "bc: ".$_SESSION['mail'];
		
		$betreff = "Ihre Anmeldung an der Berufsbildenden Schule 1 - Mainz";

		mail($empfaenger, $betreff, $bodytext, implode("\r\n", $header));
		
		//echo "<p><b>Ihre Nachricht wurde versendet!</b></p>";
		
	} else {
	
	
	echo "<form id='form_mail' method='post' action='./datenblatt.php?id=".$id."'>";
	
	//Mailtext:
	echo "<label><textarea name='bodytext_final' cols='100'  rows='15'>".$bodytext."</textarea></p></label>";


	//echo "<input type='hidden' name='bodytext_final' value='".$bodytext_final."'>";
	echo "<input type='hidden' name='empfaenger' value='".$bew['mail']."'>";
	echo "<input type='hidden' name='cc' value='".$cc."'>";

	echo "<br>";
	echo "<input class='btn btn-default btn-sm' name='submit_senden' type='submit' value='E-Mail versenden'>";

echo "</form>";
	}
	  
	  
	  ?>
	  
	  </div>
   </figure>
</div>


<?php
		}

?>


<table>

<tr height="50"></tr>
<tr>

<?php
if ($_GET['back'] == "todo") {

echo "<td>
<form method='post' action='./todo.php?id=".$bew['id']."'>";
?>
<input class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="zurück" />
</form>
</td>
<?php
} else {
?>
<td>
<form method="post" action="./liste.php">
<input class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="zurück" />
</form>
</td>
<?php

}

if ($_SESSION['sek'] == 1 OR $_SESSION['admin'] == 1) {
	$bew_md5 = $bew['md5'];	
	$select_md5 = $db_temp->query("SELECT * FROM summen WHERE (md5 = '$bew_md5')");
	$treffer_md5 = $select_md5->rowCount();

		if ($treffer_md5 > 0) {	
			echo "<td style='padding-left: 3em;'>";
			echo "<form method='post' action='./md5_loeschen.php?id=".$bew['id'].".php'>";
			echo "<input class='btn btn-default btn-sm' type='submit' style='background-color: red; border: 0;' name='cmd[doStandardAuthentication]' value='weitere Anmeldung für ".strtoupper($bil['schulform'])." zulassen' />";
			echo "</form>";
			echo "</td>";
		}
		
	echo "<td style='padding-left: 3em;'>";
	echo "<form method='post' action='./pdf.php?id=".$bew['id'].".php&schuljahr=".$_SESSION['schuljahr']."'>";
	echo "<input class='btn btn-default btn-sm' type='submit' border: 0;' name='cmd[doStandardAuthentication]' value='Anschreiben drucken' />";
	echo "</form>";
	echo "</td>";

	//Einzeltrasfer
	
	if ($xls_download == 1) {
		echo "<form id='form5' action='./export_py.php' method='POST'>";
	} else {
		echo "<form id='form5' action='./export_csv.php' method='POST'>";
	}
	
	if (($_SESSION['sek'] == 1 OR $_SESSION['admin'] == 1) AND $_SESSION['papierkorb'] != 1 AND $bew['status'] == "vollständig") {
	
		echo "<td style='padding-left: 3em;'>";
			echo "<input type='hidden' name='f_nachname' value='".$bew['nachname']."'>";
			echo "<input type='hidden' name='f_vorname' value='".$bew['vorname']."'>";
			echo "<input type='hidden' name='f_geburtsdatum' value='".$bew['geburtsdatum']."'>";
			echo "<input style='width: 100%' class='btn btn-default btn-sm' type='submit' name='submit_filter' value='Einzeltransfer'>";
		echo "</td>";
	
	}
	echo "</form>";
}

if (($_SESSION['admin'] == 1 OR $_SESSION['sek'] == 1) AND $bew['status'] != "übertragen") {
echo "<td style='padding-left: 3em;'>";
echo "<form method='post' action='./anmeldung_papierkorb.php?id=".$bew['id'].".php'>";
if ($bew['papierkorb'] == 1) {
	echo "<input type='hidden' name='pap_rein' value='0'>";
	echo "<input class='btn btn-default btn-sm' type='submit' style='background-color: orange; border: 0;' name='cmd[doStandardAuthentication]' value='Anmeldung wiederherstellen' />";
} else {
	echo "<input type='hidden' name='pap_rein' value='1'>";
	echo "<input class='btn btn-default btn-sm' type='submit' style='background-color: orange; border: 0;' name='cmd[doStandardAuthentication]' value='Anmeldung in Papierkorb' />";
}
echo "</form>";
echo "</td>";

}

if ($_SESSION['admin'] == 1 AND $_SESSION['username'] != "luzius" AND $_SESSION['username'] != "soyer") {
echo "<td style='padding-left: 3em;'>";
echo "<form method='post' action='./anmeldung_loeschen.php?id=".$bew['id'].".php'>";
echo "<input class='btn btn-default btn-sm' type='submit' style='background-color: red; border: 0;' name='cmd[doStandardAuthentication]' value='Anmeldung löschen' />";
echo "</form>";
echo "</td>";

}
?>

</tr>
<tr height="20"></tr>
<tr>
<td>
<form method="post" action="./logout_ad.php">
<input type="submit" name="cmd[doStandardAuthentication]" value="Abmelden" />
</form>
</td>
</tr>


</table>

<?php


} else {
   echo "Bitte erst authentifizieren!";
   header("Location: ./betriebe_anfrage.php");

}

include("./fuss.php");

?>
