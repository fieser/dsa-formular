<?php
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

    // Liste zur Speicherung der Straßen
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
        return "Die Straße ist korrekt.";
    }

    // Überprüfen auf ähnliche Straßen
    foreach ($streets as $validStreet) {
        $similarity = levenshteinSimilarity($strasse, $validStreet);
        if ($similarity >= 0.6) {
            return "Meinten Sie: " . $validStreet . "? (Ähnlichkeit: " . round($similarity * 100, 2) . "%)";
        }
    }

    return "Straße nicht gefunden und keine ausreichende Ähnlichkeit vorhanden.";
}

// Funktion zur Berechnung der Levenshtein-Ähnlichkeit in Prozent
function levenshteinSimilarity($str1, $str2) {
    $levDist = levenshtein($str1, $str2);
    $maxLen = max(strlen($str1), strlen($str2));
    return ($maxLen - $levDist) / $maxLen;
}

// Beispielaufruf der Funktion
$strasse = 'Invalidenstrase';
$plz = '10115';
echo checkAndCorrectStreet($strasse, $plz);
?>
