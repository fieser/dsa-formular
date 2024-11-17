<?php
@session_start();



/*
$schule_name1 = 'Berufsbildende Schule 1';
$schule_name2 = '- Gewerbe und Technik -';
$schule_strasse_nr = 'Am Judensand 12';
$schule_plz_ort = '55122 Mainz';
*/

$schule_name1 = $_SESSION['schule_name1'];
$schule_name2 = $_SESSION['schule_name2'];
$schule_strasse_nr = $_SESSION['schule_strasse_nr'];
$schule_plz_ort = $_SESSION['schule_plz_ort'];



// Include the main TCPDF library (search for installation path).
require_once('./tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 10, '', 10, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Seite '.$this->getAliasNumPage().' von '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BBS1 Mainz');
$pdf->SetTitle('Bestätigung der Anmeldung');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);
if ($_SESSION['schulform'] != "bs") {
// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<p><br><br><br><br>
<small>'.$_SESSION["vorname"].' '.$_SESSION["nachname"].' - '.$_SESSION["strasse"].' '.$_SESSION["hausnummer"].' - '.$_SESSION["plz"].' '.$_SESSION["wohnort"].'</small><br>
&nbsp;<br>'.$schule_name1.'
<br>'.$schule_name2.'<br>
<br>'.$schule_strasse_nr.'
<br>'.$schule_plz_ort.'
</p>
<br>&nbsp;
<br>&nbsp;<p align="right">'.$_SESSION["wohnort"].', '.date("d.m.Y").'</p>
<br>&nbsp;
<br>&nbsp;
<h3>Zusendung Bewerbungsunterlagen</h3>

&nbsp;<br>
<p>Sehr geehrte Damen und Herren,<br><br>
im Anhang finden Sie meine Bewerbungsunterlagen zu meiner am '.date("d.m.Y").' erfolgten Onlineanmeldung.</p>
<br>&nbsp;<br>
Mit freundlichen Grüßen<br>
	&nbsp;
<br>&nbsp;
<br>&nbsp;
<br>'.$_SESSION["vorname"].' '.$_SESSION["nachname"].'
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

$html = '<p align="right" style="margin-top: 0px;">'.$_SESSION["wohnort"].', '.date("d.m.Y").'</p>

<h1>Ihre Anmeldedaten</h1>

<table width="100%" style="color: black; background-color: #E0E0E0; line-height: 30px;">
<tr><td><b>Nachname:</b></td><td width="30px"></td><td width="400px">'.$_SESSION["nachname"].'</td></tr>
<tr><td><b>Vorname:</b></td><td width="30px"></td><td>'.$_SESSION["vorname"].'</td></tr>
<tr><td><b>Geburtsdatum:</b></td><td width="30px"></td><td>'.date("d.m.Y",strtotime($_SESSION["geburtsdatum"])).'</td></tr>
<tr><td><b>Geburtsort:</b></td><td width="30px"></td><td>'.$_SESSION["geburtsort"].'</td></tr>

<tr><td>&nbsp;</td></tr>

<tr style="line-height: 8px;"><td><b>Anschrift:</b></td><td width="30px"></td><td>'.$_SESSION["strasse"].' '.$_SESSION["hausnummer"].'</td></tr>
<tr><td><b></b></td><td width="30px"></td><td>'.$_SESSION["plz"].' '.$_SESSION["wohnort"].'</td></tr>
<tr><td><b>E-Mail:</b></td><td width="30px"></td><td>'.$_SESSION["mail"].'</td></tr>
<tr style="line-height: 8px;"><td><b>Telefon:</b></td><td width="30px"></td><td>'.$_SESSION["telefon1"].'</td></tr>
<tr><td><b></b></td><td width="30px"></td><td>'.$_SESSION["telefon2"].'</td></tr>
';
if ($_SESSION['schulform'] == "bs" AND $_SESSION['beruf'] != "sonstiger") {
	
	
		$beruf_anz = $_SESSION["beruf_anz"];
		

			
			$html .= '<tr style="line-height: 15px;"	><td><b>Beruf:</b></td><td width="30px"></td><td>'.$beruf_anz.'</td></tr>
						';

}

if ($_SESSION['schulform'] == "bs" AND $_SESSION['beruf'] == "sonstiger") {
	
	
					
			$html .= '<tr style="line-height: 15px;"	><td><b>Beruf:</b></td><td width="30px"></td><td>'.$_SESSION["beruf2"].'</td></tr>
						';

}

if ($_SESSION['schulform'] == "bs") {
	
	
					
			$html .= '<tr><td><b>Ausbildungszeitraum:</b></td><td width="30px"></td><td>'.date("d.m.Y",strtotime($_SESSION["beginn"])).' bis '.date("d.m.Y",strtotime($_SESSION["ende"])).'</td></tr>
						';

}

if ($_SESSION['schulform'] == "bvj") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufsvorbereitungsjahr (BVJ)</td></tr>
						';

}
if ($_SESSION['schulform'] == "bf1") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufsfachschule 1 (BF 1)</td></tr>
						';

}

if ($_SESSION['schulform'] == "bf2") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufsfachschule 2 (BF 2)</td></tr>
						';

}

if ($_SESSION['schulform'] == "bos1") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufsoberschule 1 (BOS 1)</td></tr>
						';

}

if ($_SESSION['schulform'] == "bos2") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufsoberschule 2 (BOS 2)</td></tr>
						';

}

if ($_SESSION['schulform'] == "dbos") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Duale Berufsoberschule (DBOS)</td></tr>
						';

}

if ($_SESSION['schulform'] == "hbf") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Höhere Berufsfachschule (HBF)</td></tr>
						';

}

if ($_SESSION['schulform'] == "fs") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Fachschule (FS)</td></tr>
						';

}

if ($_SESSION['schulform'] == "bgy") {
		
			$html .= '<tr><td><b>Schulform:</b></td><td width="30px"></td><td>Berufliches Gymnasium (BGY)</td></tr>
						';

}

if ($_SESSION['bgy_sp1'] != "" AND $_SESSION['schulform'] != "bs" AND $_SESSION['schulform'] != "bvj" AND $_SESSION['schulform'] != "dbos") {
		
			$html .= '<tr><td><b>Schwerpunkt (1. Wunsch):</b></td><td width="30px"></td><td>'.$_SESSION["bgy_sp1"].'</td></tr>
						';

}

if ($_SESSION['bgy_sp2'] != "" AND $_SESSION['schulform'] != "bs" AND $_SESSION['schulform'] != "bvj" AND $_SESSION['schulform'] != "dbos") {
		
			$html .= '<tr><td><b>Schwerpunkt (2. Wunsch):</b></td><td width="30px"></td><td>'.$_SESSION["bgy_sp2"].'</td></tr>
						';

}

if ($_SESSION['bgy_sp3'] != "") {
		
			$html .= '<tr><td><b>Schwerpunkt (3. Wunsch):</b></td><td width="30px"></td><td>'.$_SESSION["bgy_sp3"].'</td></tr>
						';

}

if ($_SESSION['fs1'] != "" AND $_SESSION['schulform'] != "bs" AND $_SESSION['schulform'] != "bvj" AND $_SESSION['schulform'] != "dbos") {
		
			$html .= '<tr><td><b>Fremdsprachen:</b></td><td width="30px"></td><td>'.$_SESSION["fs1"].' von '.$_SESSION["fs1_von"].' bis '.$_SESSION["fs1_bis"].'</td></tr>
						';

}

if ($_SESSION['fs2'] != "") {
		
			$html .= '<tr><td><b></b></td><td width="30px"></td><td>'.$_SESSION["fs2"].' von '.$_SESSION["fs2_von"].' bis '.$_SESSION["fs2_bis"].'</td></tr>
						';

}
if ($_SESSION['fs3'] != "") {
		
			$html .= '<tr><td><b></b></td><td width="30px"></td><td>'.$_SESSION["fs3"].' von '.$_SESSION["fs3_von"].' bis '.$_SESSION["fs3_bis"].'</td></tr>
						';

}

$html .= '</table>';





$html .= '<br>&nbsp;<h2>Bitte beachten Sie folgende Informationen:</h2>'.$_SESSION["text_sf"].'';
//$html .= '<table width="100%" style="color: black; background-color: #E0E0E0;>';
//$html .= '<tr><td>';
if ($_SESSION['schulform'] != "bs") {
$html .= '<br><p><b>Sie können Dokumente auch online einreichen</b>, sofern es sich um Dokumente handelt,<br><b>die nicht beglaubigt sein müssen</b>.<br>';
$html .= 'Nutzen Sie für den Upload bitte den folgenden Link:</p>';
$html .= '<p style="margin: 0px; color: blue; letter-spacing: -1px; font-size: 1.1em;">'.$_SESSION['link_upload'].'</p>';
}
//$html .= '</td></tr>';
//$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('anmeldung_bbs1-mainz.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+