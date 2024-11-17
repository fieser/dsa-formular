<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");





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
</head>
<body>
    <h1 style='margin-bottom: 2em;'>Digitale Anmeldeformulare</h1>
<?php

if ($bs_aktiv == 1) {
echo "<form method='post' action='./ausbildung.php'>";
echo "<input style='width: 23.3em; margin-bottom: 2em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsschule' />";
echo "</form>";
}

	
if ($bgy_aktiv == 1) {
echo "<form class='flex-container' method='post' action='./bewerberdaten.php?sf=bgy'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufliches Gymnasium (BGY)' />";
echo "</form>";
}
if ($bvj_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bvj'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsvorbereitungsjahr (BVJ)'/>";
echo "</form>";
}
if ($bf1_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bf1'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsfachschule 1 (BF 1)' />";
echo "</form>";
}
if ($bf2_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bf2'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsfachschule 2 (BF 2)' />";
echo "</form>";
}
if ($hbf_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=hbf'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Höhere Berufsfachschule (HBF)' />";
echo "</form>";
}
if ($bos1_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bos1'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsoberschule 1 (BOS 1)'/>";
echo "</form>";
}
if ($bos2_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=bos2'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Berufsoberschule 2 (BOS 2)'/>";
echo "</form>";
}
if ($dbos_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=dbos'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Duale Berufsoberschule (DBOS)' />";
echo "</form>";
}
if ($fs_aktiv == 1) {
echo "<form  class='flex-container' method='post' action='./bewerberdaten.php?sf=fs'>";
echo "<input style='width: 23.3em;' class='btn btn-default btn-sm' type='submit' name='cmd[doStandardAuthentication]' value='Fachschule (FS)' />";
echo "</form>";
}

echo "</body>";
echo "</html>";



include("./fuss.php");

?>
