<?php

date_default_timezone_set('Europe/Berlin');

@session_start();

$unterzeichner = "Janine Gau, StD´<br><small>(Zweite Stellvertreterin des Schulleiters)</small>";
$veranstaltung = $_GET['id'];
$rechnungs_datum = date("d.m.Y");
$lieferdatum = date("d.m.Y");
$pdfAuthor = $l_email;

$pdf_datum = time();
$pdf_vorname = 'Datum';
$pdf_nachname = 'Datum';
$pdf_kuerzel = 'Datum';
$pdf_zeit_von = 'Datum';
$pdf_zeit_bis = 'Datum';
$pdf_dozenten1 = 'Datum';
$pdf_dozenten2 = 'Datum';
$pdf_form = 'Datum';
$pdf_zertifikat_text = 'Datum';

$timestamp = strtotime($pdf_datum); 
$newDate = date("d.m.Y", $timestamp );
 
$rechnungs_header = '';

$pdf_thema = $_SESSION[$veranstaltung.'pdf_thema'];

$dozenten = $pdf_dozenten2;

$dozenten_text = 'Diese Fortbildung wurde von '.$dozenten. ' im Auftrag der Berufsbildende Schule 1 Mainz durchgeführt.';
 
$bescheinigungstext = '<b><font style="text-align: center;">'.$pdf_vorname.' '.$pdf_nachname.'</font></b><br><br>
hat am '.$newDate.' von '.$pdf_zeit_von.' bis '.$pdf_zeit_bis.' Uhr<br>an der ';
if ($pdf_form == 'online') {
$bescheinigungstext .= 'Onlinefortbildung';
} else {
$bescheinigungstext .= 'Fortbildung';
}

$bescheinigungstext .= '<p style="font-size:1.4em;"><i>"'.$pdf_thema.'"</i></p><br>
teilgenommen.<br><br>';


if ($pdf_zertifikat_text != '') {
$inhalt = '<td style="text-align: center;"><p style="text-align: left;">Inhalt der Veranstaltung:</p><p style="text-align: left;">'.$pdf_zertifikat_text.'</p></td>';
} else {
	//$inhalt = '';
}


$fuss = "Mainz, ".$rechnungs_datum."
<br><br><br>
i.A. ".$unterzeichner;

$pdfName = "Bescheinigung_".$pdf_kuerzel."_".$veranstaltung.".pdf";
 
 
//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
 
// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.
 
$html = '<table cellpadding="5" cellspacing="0" style="width: 100%;">
 <tr>
 <td colspan="2" style="text-align: right;" >'.nl2br(trim($rechnungs_header)).'</td>
    
 </tr>
 
 <tr>
 <td width="70%"></td>
 <td text-align="left"><small>
Am Judensand 12<br>
 55122 Mainz<br><br>
 Telefon 06131-90603-0<br>
 Telefax 06131-90603-99<br>
 www.bbs1-mainz.de<br>
 sekretariat@bbs1-mainz.de
 </small>
 </td>
 </tr>
 </table>
 <table cellpadding="5" cellspacing="0" style="width: 80%;">
 <tr>
 <td style="font-size:1.8em; text-align: center;">
<br><br>Teilnahmebescheinigung
<br>
 </td>
 </tr>
 
 
 <tr>
 <td colspan="2" style="text-align: center;">'.nl2br(trim($bescheinigungstext)).'</td>
 </tr>
 
  <tr>
 <td colspan="1" style="text-align: center;">'.nl2br(trim($inhalt)).'</td>
 </tr>
</table>

<table cellpadding="5" cellspacing="0" border="0" style="width: 90%;">
 <tr>
 <td text-align="left">'.nl2br(trim($dozenten_text)).'</td>
 </tr>
</table>
<br><br><br>';
 
 
 
$html .= '
<tablecellpadding="5" cellspacing="0" style="width: 100%;" border="0">';

 
$html .='

        </table>';
 

 $html .= '<br><br><br><br><br><br>';
 
$html .= nl2br($fuss);
 
 
 
//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 
// TCPDF Library laden
require_once('tcpdf/tcpdf.php');
 
// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Bescheinigung_'.$veranstaltung.'_'.$pdf_kuerzel);
$pdf->SetSubject('Bescheinigung_'.$pdf_kuerzel.'_'.$veranstaltung);
 
 
// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// Auswahl der MArgins
//$pdf->SetMargins(30, 10, PDF_MARGIN_RIGHT);
$pdf->SetMargins(25, 10, 10);
$pdf->SetHeaderMargin(5);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// Schriftart
$pdf->SetFont('dejavusans', '', 10);
 
// Neue Seite
$pdf->AddPage();
 
// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
$pdf->Output($pdfName, 'I');
 
//Variante 2: PDF im Verzeichnis abspeichern:
//$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
//echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';
 
?>