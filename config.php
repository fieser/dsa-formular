 <?php
 



 // URL zum Verzeichnis in dem die PHP-Dateien und Unterordner abgelegt wurden:
 $url = "https://service.bbs1-mainz.de/"; // BITTE mit / abschließen!
 


$_SESSION['schule_name1'] = 'Berufsbildende Schule 1';
$_SESSION['schule_name2'] = '- Gewerbe und Technik -';;
$_SESSION['schule_strasse_nr'] = 'Am Judensand 12';
$_SESSION['schule_plz_ort'] = '55122 Mainz';
	
	
//Einstellungen:
$vorbelegen_sorge1 = 1; //Adressdaten von Sorgeberechtigter 1 wird bei Minderjährigen mit deren Adressdaten vorbelegt.
$strasse_pruefen = 1;

//Schuljahr:
$schuljahresbeginn_n = "18.08.2025"; //Beginn nächstes Schuljahr
$schuljahresbeginn_a = "26.08.2024"; //Beginn aktuelles Schuljahr
$schuljahr_n = "2025-2026"; //Nächstes Schuljahr
$schuljahr_a = "2024-2025"; //Aktuelles Schuljahr

// Verbindung zur Datenbank aufbauen.
//include "/var/www/verbinden.php";

include "/var/www/verbinden_temp.php";


//Schulformen aktivieren/deaktivieren:
$bs_aktiv = 1;
$bvj_aktiv = 1;
$aph_aktiv = 0;
$bf1_aktiv = 1;
$bf2_aktiv = 1;
$bfp_aktiv = 0;
$bos1_aktiv = 0;
$bos2_aktiv = 0;
$dbos_aktiv = 1;
$bgy_aktiv = 1;
$fs_aktiv = 1;
$fsof_aktiv = 0;
$hbf_aktiv = 1;

//Wie sind Sie auf uns aufmerksam geworden?

$umfrage = 1;

//Einstellungen:
$min_anzahl_betriebe = 4; //Wenn weniger Betriebe zum Beruf gefunden werden, werden alle Betriebe angezeigt.
$upload_dokumente = 1;

$wartungsmodus = 0;
$wartungsmodus_ende = "01.05.2024"; //einschließlich diesem Datum

$popup_anzeigen_sj = true; // Setze auf false, um das Popup zu deaktivieren

// FUNKTIONEN:

function umlauteumwandeln($str){
 $tempstr = Array("Ä" => "AE", "Ö" => "OE", "Ü" => "UE", "ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss"); 
 return strtr($str, $tempstr);
 }

function dateivergleich($a,$b) {
	$ah = md5_file($a);
	$bh = md5_file($b);
	
	if ($ah == $bh) {
		return "true";
	} else {
		return "false";
	}	
} //Ende Funktion


// Funktion Überprüfung Straße

// Funktion zur Überprüfung und Korrektur eines Straßennamens mit Overpass API
function checkAndCorrectStreet($strasse, $plz) {
    // URL für die Nominatim API, um Koordinaten für die PLZ zu erhalten
    $nominatimUrl = "https://nominatim.openstreetmap.org/search?postalcode=" . urlencode($plz) . "&countrycodes=de&format=json&addressdetails=1&limit=1";

    // Initialisieren von cURL
    $ch = curl_init();

    // cURL-Optionen setzen
    curl_setopt($ch, CURLOPT_URL, $nominatimUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Nur für Debugging-Zwecke, nicht empfohlen für Produktionsumgebungen
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: MyGeocodingApp/1.0 (myemail@example.com)')); // User-Agent-Header hinzufügen

    // API-Aufruf durchführen
    $nominatimResponse = curl_exec($ch);

    // Überprüfen, ob der API-Aufruf erfolgreich war
    if ($nominatimResponse === FALSE) {
        die('cURL-Fehler: ' . curl_error($ch));
    }

    // HTTP-Statuscode überprüfen
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode != 200) {
        die('Fehler beim Abrufen der Daten von Nominatim API. HTTP-Statuscode: ' . $httpCode);
    }

    // JSON-Daten dekodieren
    $nominatimJson = json_decode($nominatimResponse, true);

    // cURL schließen
    curl_close($ch);

    // Überprüfen, ob die JSON-Daten korrekt dekodiert wurden
    if ($nominatimJson === NULL) {
        die('Fehler beim Dekodieren der JSON-Daten.');
    }

    if (empty($nominatimJson)) {
        die('Keine Daten von Nominatim API erhalten.');
    }

    $lat = $nominatimJson[0]['lat'];
    $lon = $nominatimJson[0]['lon'];

    // URL für die Overpass API, um Straßen in einem bestimmten Bereich zu erhalten
    $overpassUrl = "http://overpass-api.de/api/interpreter?data=[out:json];way(around:500," . $lat . "," . $lon . ")[highway];out;";

    // API-Aufruf
    $overpassResponse = file_get_contents($overpassUrl);
    $overpassJson = json_decode($overpassResponse, true);

    if (empty($overpassJson) || !isset($overpassJson['elements'])) {
        die('Keine Daten von Overpass API erhalten.');
    }

    // Initialisieren eines Arrays zur Speicherung der Straßen
    $streets = [];

    // Funktion zur Abrufung von Straßen in einem bestimmten Bereich
    function getStreets($lat, $lon, $radius) {
        $overpassUrl = "http://overpass-api.de/api/interpreter?data=[out:json];way(around:$radius,$lat,$lon)[highway];out;";
        $overpassResponse = file_get_contents($overpassUrl);
        $overpassJson = json_decode($overpassResponse, true);
        return $overpassJson['elements'] ?? [];
    }

    // Abfragen in vier Quadranten mit 1000 Meter Radius
    $radius = 1000;
    $areas = [
        getStreets($lat + 0.01, $lon, $radius), // Nord
        getStreets($lat - 0.01, $lon, $radius), // Süd
        getStreets($lat, $lon + 0.01, $radius), // Ost
        getStreets($lat, $lon - 0.01, $radius), // West
    ];

    // Straßen aus allen Bereichen sammeln
    foreach ($areas as $area) {
        foreach ($area as $element) {
            if (isset($element['tags']['name']) && !in_array($element['tags']['name'], $streets)) {
                $streets[] = $element['tags']['name'];
            }
        }
    }

    // Überprüfen, ob die Straße in der Liste existiert
    if (in_array($strasse, $streets)) {
        //return "Die Straße ist korrekt.";
    }
$vergleiche = 0;
    // Überprüfen auf ähnliche Straßen
    foreach ($streets as $validStreet) {
        $similarity = levenshteinSimilarity($strasse, $validStreet);
        if ($similarity >= 0.9) {
            //return "Meinten Sie: " . $validStreet . "? (Ähnlichkeit: " . round($similarity * 100, 2) . "%)";
			return $validStreet;
			$vergleiche = ($vergleiche + 1);
        }
    }

    //return "Straße nicht gefunden und keine ausreichende Ähnlichkeit vorhanden.";
	if ($vergleiche == 0) {
	return $strasse;
	}
}

// Funktion zur Berechnung der Levenshtein-Ähnlichkeit in Prozent
function levenshteinSimilarity($str1, $str2) {
    $levDist = levenshtein($str1, $str2);
    $maxLen = max(strlen($str1), strlen($str2));
    return ($maxLen - $levDist) / $maxLen;
}

// Beispielaufruf der Funktion
//$strasse = 'Invalidenstrase';
//$plz = '10115';
//echo checkAndCorrectStreet($strasse, $plz);


	

	
