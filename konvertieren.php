<?php

include("./kopf.php");


date_default_timezone_set('Europe/Berlin');



@session_start();



$beginn_schuljahr = strtotime("01.08.".date("Y"));
$jahr = date("Y");
$jahr2 = $jahr[2].$jahr[3];



include("./config.php");




	
	
	
		/*		
	echo "<pre>";
	print_r ( $_POST );
	echo "</pre>";
	*/
	
	
//Temp-DB:
	include "../../verbinden_temp.php";

	$select_temp = $db_temp->query("SELECT * FROM dsa_bildungsgang");

	foreach ($select_temp as $temp) {
		
		$md5 = $temp['md5'];
		$schulform = $temp['schulform'];
		
		echo $md5."<br>";


			if ($db_temp->exec("UPDATE `summen`
						   SET
							`schulform` = '$schulform' WHERE `md5` = '$md5'")) {
								
								echo $md5."<br>";
			}


	}






						
						

					


	


include("./fuss.php");

?>
