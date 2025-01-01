<?php 
@session_start();

//Izo Time
date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$zeitstempel = date("Y.m.d",$timestamp);
include ("./config.php");




include "./kopf.php";


if (isset($_POST['email'])) {
	
 $email_anfrage = $_POST['email'];
 
 
 // Bearbeiten des Formulars //
if ($_POST['captcha_code'] == $_SESSION['captcha_spam']) {
// Das Captcha wurde korrekt ausgefüllt //


$select_ab = $db_temp->query("SELECT * FROM ausbilder WHERE (ausbilder_mail LIKE '$email_anfrage')");
$treffer_ab = $select_ab->rowCount();
				  

				  
		if ($treffer_ab == 0) {

			//Püfen ob es andere Nutzer mit der Maildomain gibt:
			$teilung_mail = explode("@", $email_anfrage);
			$domain = $teilung_mail[1];

			$select_abd = $db_temp->query("SELECT * FROM ausbilder WHERE (ausbilder_mail LIKE '%$domain'
			AND ausbilder_mail NOT LIKE '%gmx.%' 
			AND ausbilder_mail NOT LIKE '%gmail.%' 
			AND ausbilder_mail NOT LIKE '%outlook.%')");
			$treffer_abd = $select_abd->rowCount();
			
			echo "<p>Ihre E-Mail-Adresse konnte keinem aktiven Konto zugeordnet werden.</p>";
			echo "<p>Haben Sie sich evtl. vertippt oder wurde Ihre E-Mail-Adresse nicht von unserem Sekretariat erfasst?</p>";
			echo ' <br>';
			if ($treffer_abd > 0) {
				echo "<p>Es gibt jedoch andere Nutzer mit der Maildomain <i>$domain</i>:</p>";
				echo "<p>";
				foreach($select_abd as $abd) {
					echo "<b><i> ".$abd['ausbilder_mail']."</i></b><br>";
				}
				echo "</p>";
			}
			?>
			<table>
			<tr height="30" style='margin-top: 1em;'></tr>
			<tr>
			<td>
			<form method="post" action="betriebe_anfrage.php">
			<input class="btn btn-default btn-sm" type="submit" name="cmd[doStandardAuthentication]" value="erneut versuchen" />
			</form>
			</td>
			</tr>
			<?php
		}
		
		if ($treffer_ab > 1) {
			
			echo "<br><h2><b>Ihre E-Mail-Adresse konnte nicht eindeutig zugeordnet werden!</b></h2>";
			echo '<br>';
?>
<tr height="30"></tr>
<tr>
<td>
<form method="post" action="betriebe_anfrage.php">
<input class="btn btn-default btn-sm" type="submit" name="cmd[doStandardAuthentication]" value="erneut versuchen" />
</form>
</td>
</tr>
<?php
		}
		
		if ($treffer_ab == 1) {

			foreach($select_ab as $ab) {
				$ausbilder_id = $ab['id'];
				$ausbilder_betrieb_id = $ab['ausbilder_betrieb_id'];
			}
			
			echo "<br><h2>Sie wurden eindeutig als Ausbilder/-in identifiziert.</h2>";
			echo "<p>Sie erhalten in Kürze eine Email mit einem Zugangslink.<br>Bitte klicken Sie auf den Link in der E-Mail!</p>";
		
		$zufallszahl = rand(10000,10000000);
	


// Datensatz einfügen.
if ($db_temp->exec("INSERT INTO `anfrage`
               SET
                `mail_anfrage` = '$email_anfrage',
                `zufall` = '$zufallszahl',
				`id_betrieb` = '$ausbilder_betrieb_id',
				`verifiziert` = '0'")) {
//$last = "LAST_INSERT_ID(UserID)";
$last_id = $db_temp->lastInsertId();
//echo "ID: ".$last_id;
$link = $url."betrieb_login.php?num=".$zufallszahl;

}
				 
				  	// ##########  START Vorbereitung und Versand Mail mit Link #############################
	
	$mailText_abt .= "<p>Guten Tag!</p> \r\n";
	$mailText_abt .= " \n";			
	$mailText_abt .= "<p>Sie erhalten diese Email, da Sie einen Zugangslink \r\n";
	$mailText_abt .= "zu Ihren bei uns hinterlegten Betriebsdaten angefordet haben.</p> \r\n";
	$mailText_abt .= " \n";
	$mailText_abt .= "<p>Ignorieren Sie diese E-Mail, wenn Sie keinen Zugangslink angefordert haben!</p> \r\n";
	
	$mailText_abt .= " \n";
	$mailText_abt .= " \n";
	$mailText_abt .= " \n";
	$mailText_abt .= "<p>Klicken Sie auf folgenden Link,<br>wenn Sie die bei uns aktuelle hinterlegten Daten einsehen möchten:</p> \n";
	
	$mailText_abt .= " \n";
	
	$mailText_abt .= " \n";
	
	$mailText_abt .= "<p><a href='".$url."/betriebe_login.php?num=".$zufallszahl."'>Datenblatt Ihres Betriebes</a></p> \r\n";
	$mailText_abt .= " \n";

	$mailText_abt .= " \n";
	$mailText_abt .= "<p>Wenden Sie sich bitte an <a href='mailto:edv@bbs1-mainz.de'>edv@bbs1-mainz.de</a>, falls Sie wiederholt ungewollt diese E-Mail erhalten sollten.</a></p> \r\n";
	
	$mailText_abt .= " \n";
	
	$mailText_abt .= "<p>Mit freundlichen Grüßen</p>\r\n";
	$mailText_abt .= "<p><i>Ihr EDV-Team der BBS1</i></p>\r\n";
	$mailText_abt .= " \n";


// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
$header[] = 'MIME-Version: 1.0';
$header[] = 'Content-type: text/html; charset=utf-8';


$header[] = 'From: IT BBS1 Mainz <no_reply@bbs1-mainz.de>';
// $header[] = 'Bcc: edv@bbs1-mainz.de';

mail($email_anfrage, "Bestaetigen Sie Ihre Anfrage!", $mailText_abt, implode("\r\n", $header));

$mailText_abt = "";

// ###################### ENDE Mail versenden ###########################
		
		}		
				  
				  

 
 } else {
// Captcha wurde falsch ausgefüllt, Fehler ausgeben. //
echo '<br>';
echo "<font color='red'><b>Sie haben den Captcha-Code falsch eingegeben!</b></font><br>";
echo ' <br>';
?>
<tr height="30"></tr>
<tr>
<td>
<form method="post" action="betriebe_anfrage.php">
<input class="btn btn-default btn-sm" type="submit" name="cmd[doStandardAuthentication]" value="erneut versuchen" />
</form>
</td>
</tr>
<?php


//echo "<meta http-equiv='refresh' content=\"0; URL=anfrage.php\">";

}

} else { 



?>
<h1>Zugangslink anforden</h1><br>

<p>Wenn Ihre Email-Adresse in unserem Schulverwaltungsprogramm hinterlegt ist, können Sie einen Zugangslink anfordern.
<br>Über den Zugangslink können Sie sich die zu Ihrem Betrieb bei uns hinterlegten Daten anzeigen lassen, sie überprüfen und ggf. von unserem Sekretariat korrigieren oder ergänzen lassen.</p>
</p>
<p>Bitte geben Sie Ihre bei uns in der Schule hinterlegte <i>Email-Adresse</i> an.<br>
Sie können eine beliebige zu Ihrem Unternehmen bei uns gespeicherte Email-Adresse angeben, müssen aber persönlich Zugriff auf dieses Email-Konto haben.</p>

<p>&nbsp;</p>
<?php

?>
    <form action="./betriebe_anfrage.php" method="POST">
	<table>

        <tr height="40"><td><label for="email">Ihre E-Mail-Adresse:&nbsp;&nbsp;</label></td><td><input id="email" type="email" name="email" /></td></tr>
        <tr height="20"><td></td></tr>
		<tr height="40"><td></td><td><img src="captcha/captcha.php?RELOAD=" alt="Captcha" title="Klicken, um das Captcha neu zu laden" onclick="this.src+=1;document.getElementById('captcha_code').value='';" width=140 height=40 /></td></tr>
		<tr height="30"><td></td><td><i>(Klicken Sie auf das Bild, wenn der Code nicht richtig lesbar ist.)</i></td></tr>
		<tr height="60"><td>Captcha-Code:</td><td><input type="text" name="captcha_code" id="captcha_code" size=10 /></td></tr>
		
		<tr height="50"><td></td><td><input class="btn btn-default btn-sm" type="submit" name="submit" value="Nutzerdaten anfordern" /></td></tr>
    </form>
	</table>

<?php

}
?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<table>
	<p>Kontaktieren Sie unser Sekretariat (<a href='mailto:sekretariat@bbs1-mainz.de'>sekretariat@bbs1-mainz.de</a>), falls Ihre E-Mail-Adresse nicht bei uns hinterlegt ist!</p>
	
<tr height="30"></tr>
<tr>
<td>
<?PHP
if ($_GET['back'] == "abmeldung") {
	?>
	<form method="post" action="./abmeldung.php">
<input type="submit" name="cmd[doStandardAuthentication]" value="zurück" />
</form>
	<?php
	
} else {

echo "<form method='post' action='".$url."'>";
	?>
<input type="submit" name="cmd[doStandardAuthentication]" value="zurück" />
</form>
<?PHP
}
?>
</td>
</tr>
</table>
<?PHP

include "./fuss.php";


?>
