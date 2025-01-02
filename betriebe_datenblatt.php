<?php

include("./kopf.php");

date_default_timezone_set('Europe/Berlin');



@session_start();



// Ist Nutzer angemeldet?
if (isset($_SESSION['betriebe_user'])) {



include "./config.php";
if ($login_betriebe == 1 AND ($wartungsmodus != 1 OR $_SERVER['REMOTE_ADDR'] == $wartungsmodus_ausnahme)) {


if (isset($_POST['submit_senden'])) {
	
	//Versand der Email dokumentieren:
	
		$id = intval($_GET['id']);
		$mailtext = $_POST['bodytext_final'];
		
		$last_user = $_SESSION['lastname'];
		$last_time = time();
	

	
	
	
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
	  if ($mail_betriebe == 1) {
	  echo "<label for='tab4'>Änderungsmitteilung</label>";
	  }
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

<?PHP
	  if ($mail_betriebe == 1) {
	  echo "<div class='tab4'>";
	  
if (!isset($_POST['submit_senden'])) {


$cc = $_SESSION['mail_anfrage'];



$bodytext = "Sehr geehrte Damen und Herren,\n";


$bodytext .= "\n";
$bodytext .= "wir bitte um folgende Änderungen unserer bei Ihnen hinterlegten Betriebsdaten:\n";

$bodytext .= "\n";
$bodytext .= "\n";
$bodytext .= "Mit freundlichen Grüßen \n";
$bodytext .= "\n";
$bodytext .= "\n";
$bodytext .= "\n";
$bodytext .= "_______________________________________________ \n";
$bodytext .= $btr['name1']."\n";
$bodytext .= $btr['name2']."\n";
$bodytext .= $btr['betrieb_strasse']." ".$btr['betrieb_hausnummer']."\n";
$bodytext .= $btr['betrieb_plz']." ".$btr['betrieb_ort']."\n";
$bodytext .= "\n";




//Kopfzeilen (optisch):
echo "<table>";
//echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>An:</b></td><td style='max-width: 60em;'>".$_SESSION['schule_mail']."</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>Cc:</b></td><td style='max-width: 60em;'>".$cc."</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td style='min-width: 3em;'><b>Betreff:&nbsp;</b></td><td style='max-width: 60em;'>Korrektur unserer Kontaktdaten</td></tr>";
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
		$header[] = "Reply-To: ".$_SESSION['mail_anfrage'];
		$header[] = 'Content-Transfer-Encoding: 8bit';
		$header[] = "cc: ".$cc;
		//$header[] = "bc: ".$_SESSION['mail'];
		
		$betreff = "Korrektur unserer Kontaktdaten";

		mail($empfaenger, $betreff, $bodytext, implode("\r\n", $header));
		
		//echo "<p><b>Ihre Nachricht wurde versendet!</b></p>";
		
	} else {
	
	
	echo "<form id='form_mail' method='post' action='./betriebe_datenblatt.php?id=".$id."'>";
	
	//Mailtext:
	echo "<label><textarea name='bodytext_final' cols='100'  rows='15'>".$bodytext."</textarea></p></label>";


	//echo "<input type='hidden' name='bodytext_final' value='".$bodytext_final."'>";
	echo "<input type='hidden' name='empfaenger' value='".$_SESSION['schule_mail']."'>";
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
	}

?>


<table>

<tr height="50"></tr>
<tr>

<?php


echo "<td>";

?>
<td>
<form method="post" action="./index.php">
<input class='btn btn-default btn-sm' type="submit" name="cmd[doStandardAuthentication]" value="zurück" />
</form>
</td>
<?php






	

//	echo "</form>";





?>

</tr>



</table>

<?php

} else {
	echo "<p>Der Zugriff auf Betriebsdaten ist momentan deaktiviert.</p>";
	echo "<p>Bitte versuchen Sie es später erneut.</p>";

}

} else {
   echo "Bitte erst authentifizieren!";
   header("Location: ./betriebe_anfrage.php");

}


include("./fuss.php");

?>
